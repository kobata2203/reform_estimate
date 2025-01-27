<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Manager;
use App\Models\Payment;
use App\Models\Estimate;
use App\Models\Breakdown;
use App\Models\Department;
use App\Models\Managerinfo;
use App\Models\EstimateInfo;
use App\Services\PdfService;
use Illuminate\Http\Request;
use App\Models\ConstructionItem;
use App\Models\ConstructionList;
use App\Models\ConstructionName;
use App\Models\EstimateCalculate;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdateEstimateRequest;

class ManagerController extends Controller
{
    protected $manager;
    protected $managerInfo;
    protected $estimateInfo;
    protected $admin;
    protected $breakdown;
    protected $estimate;
    protected $estimateCalculate;
    protected $construction;
    protected $constructionItem;
    protected $department;
    protected $payment;
    protected $constructionInfo;
    protected $constructionName;
    protected $constructionList;
    protected $estimateInitCount = 1; // 工事名の初期表示数
    protected $pdfService;

    public function __construct(

        Manager $manager,
        Managerinfo $managerInfo,
        EstimateInfo $estimateInfo,
        Admin $admin,
        Breakdown $breakdown,
        Estimate $estimate,
        EstimateCalculate $estimateCalculate,
        ConstructionList $constructionList,
        ConstructionName $constructionName,
        ConstructionItem $constructionItem,
        Department $department,
        Payment $payment,
        PdfService $pdfService,
    ) {
        $this->manager = $manager;
        $this->managerInfo = $managerInfo;
        $this->estimateInfo = $estimateInfo;
        $this->admin = $admin;
        $this->breakdown = $breakdown;
        $this->estimate = $estimate;
        $this->estimateCalculate = $estimateCalculate;
        $this->constructionList = $constructionList;
        $this->constructionName = $constructionName;
        $this->constructionItem = $constructionItem;
        $this->department = $department;
        $this->payment = $payment;
        $this->pdfService = $pdfService;
    }

    public function index(Request $request)
    {
        $keyword = $request->input('search');
        $manager_info = $this->admin->searchAdmin($keyword);
        return view('manager.index', compact('manager_info'));
    }

    public function create()
    {
        return view('manager.create');
    }

    public function store(CreateAdminRequest $request)
    {
        $validated = $request->validated();
        $this->admin->createAdmin($validated);
        return redirect()->route('manager.index')->with('success', config('message.regist_complete'));
    }

    public function edit($id)
    {
        $admin = $this->admin->findAdminById($id);
        return view('manager.edit', [
            'admin' => $admin
        ]);
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        $validated = $request->validated();

        $this->admin->updateAdmin($id, $validated);

        return redirect()->route('manager.index')->with('success', config('message.update_complete'));
    }

    public function delete($id)
    {
        // 削除処理
        $delete_admin = $this->admin->deleteAdmin($id);

        if ($delete_admin === true) {
            $message = config('message.delete_complete');
        } else {
            $message = config('message.delete_fail');
        }

        return redirect('/manager')->with([
            'message' => $message,
        ]);
    }

    public function show($id)
    {
        $estimate_info = $this->estimateInfo::getEstimateByIde($id);
        $construction_list = $this->constructionList->getByEstimateInfoId($id);

        $totalAmount = 0;
        $totalDiscount = 0;
        $totalSubtotal = 0;
        $totalTax = 0;
        $totalGrandTotal = 0;

        foreach ($construction_list as $construction) {
            $breakdown = $this->breakdown->getBreakdownsByConstructionId($construction->id);
            $amount = $breakdown->sum('amount');
            $discount = $this->estimateCalculate->getDiscountByEstimateIdAndConstructionId($id, $construction->id);
            $subtotal = $amount - $discount;
            $tax = $subtotal * 0.1;
            $grandTotal = $subtotal + $tax;

            $totalAmount += $amount;
            $totalDiscount += $discount;
            $totalSubtotal += $subtotal;
            $totalTax += $tax;
            $totalGrandTotal += $grandTotal;
        }

        return view('estimate.manager.show', [
            'estimate_info' => $estimate_info,
            'totalAmount' => $totalAmount,
            'totalDiscount' => $totalDiscount,
            'totalSubtotal' => $totalSubtotal,
            'totalTax' => $totalTax,
            'totalGrandTotal' => $totalGrandTotal,
            'construction_list' => $construction_list,
        ]);
    }


    public function itemView(Request $request, $id)
    {

        $estimate_info = $this->estimateInfo->getById($id);
        $construction_list = $this->constructionList->getByEstimateInfoId($id);
        $selectedConstructionId = $request->input('construction_name', $construction_list->first()->id ?? null);

        $breakdown = $selectedConstructionId
            ? $this->breakdown
                ->byConstructionAndEstimate($selectedConstructionId, $id)
                ->get()
            : collect([]);

        $totalAmount = $breakdown->sum('amount') ?? 0;
        $estimate_calculate = $this->estimateCalculate->getOrCreateByEstimateAndConstructionId($id, $selectedConstructionId);
        $discount = $estimate_calculate->special_discount ?? 0;
        $subtotal = $totalAmount - $discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        try {
            $estimate_calculate->updateCalculations($subtotal, $tax, $grandTotal);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorMessage = 'Error saving estimate calculations: ' . $e->getMessage();
        }

        $constructionNames = $this->constructionList
            ->select('construction_list.*')
            ->leftJoin('breakdown', 'construction_list.id', '=', 'breakdown.construction_list_id')
            ->where('construction_list.estimate_info_id', $id)
            ->whereNotNull('breakdown.id')
            ->groupBy('construction_list.id')
            ->get();

        return view('estimate.manager.item', compact(
            'breakdown',
            'estimate_info',
            'id',
            'subtotal',
            'discount',
            'tax',
            'grandTotal',
            'construction_list',
            'constructionNames',
            'selectedConstructionId',

        ));
    }

    public function updateDiscount(UpdateEstimateRequest $request, $id, $construction_id)
    {
        $validated = $request->validated();
        $estimate_info = $this->estimate->getEstimateById($id);

        if (!$estimate_info) {
            $estimate_info = new \stdClass();
        }

        $breakdown = $this->breakdown->breakdownByEstimateIdAndConstructionId($id, $construction_id);
        $totalAmount = $breakdown->sum('amount');
        $estimate_calculate = $this->estimateCalculate->createOrgetEstimateCalculate($id, $construction_id);
        $estimate_calculate->special_discount = $validated['special_discount'];
        $subtotal = $totalAmount - $estimate_calculate->special_discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        $update_estimate = $this->estimateCalculate->estimateCalculateUpdate(
            $estimate_calculate,
            $subtotal,
            $tax,
            $grandTotal
        );

        if ($update_estimate === true) {
            $message = config('message.update_complete');
        } else {
            $message = config('message.update_fail');
        }

        return redirect(url('/manager/item/' . $id))->with([
            'message' => $message,
        ]);
    }

    public function generateBreakdown($id, $construction_list_id)
    {
        return $this->pdfService->generateBreakdown($id, $construction_list_id);
    }

    public function generateCover($id)
    {
        return $this->pdfService->generateCover($id);
    }

}


