<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Manager;
use App\Models\Estimate;
use App\Models\Breakdown;
use App\Models\Managerinfo;
use App\Models\EstimateInfo;
use App\Models\ConstructionList;
use App\Models\ConstructionName;
use App\Models\ConstructionItem;
use App\Models\Department;
use App\Models\Payment;
use App\Models\EstimateCalculate;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdateEstimateRequest;
use App\Services\PdfService;


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
        $create_admin = $this->admin->createAdmin($request);

        if ($create_admin == true) {
            $message = config('message.regist_complete');
        } else {
            $message = config('message.regist_fail');
        }

        return redirect()->route('manager.index')->with([
            'message' => $message,
        ]);
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

        if($delete_admin == true) {
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
        $totalAmount = $this->breakdown::getTotalAmountByEstimateId($id);
        $discount = $this->estimateCalculate::getDiscountByEstimateId($id);
        $inputDiscount = request()->input('discount', $discount);
        //小計、税金、合計金額を計算
        $subtotal = $totalAmount - $inputDiscount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;
        $construction_list = $this->constructionList->getConnectionLists([$estimate_info]);
        $estimate_info = $this->estimateInfo::with('payment')->findOrFail($id);

        return view('estimate.manager.show', [
            'estimate_info' => $estimate_info,
            'grandTotal' => $grandTotal,
            'discount' => $inputDiscount,
            'construction_list' => $construction_list[$estimate_info->id] ?? []
        ]);
    }

    public function itemView($id)
    {
        $estimate_info = $this->estimateInfo->getById($id);

        // $construction_list = $this->constructionList->getById($id);
        $construction_list = $this->constructionList->getByEstimateInfoId($id);

        $breakdown = $estimate_info ? $this->breakdown->getByEstimateId($id) : collect([]);

        $totalAmount = $breakdown->sum('amount') ?? 0;

        $estimate_calculate = $this->estimateCalculate->getOrCreateByEstimateId($id);

        $discount = $estimate_calculate->special_discount ?? 0;
        $subtotal = $totalAmount - $discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;
        $estimate_calculate->estimate_id = $id;
        $estimate_calculate->special_discount = $discount;

        try {
            $estimate_calculate->updateCalculations($subtotal, $tax, $grandTotal);
        } catch (\Illuminate\Database\QueryException $e) {
            session()->flash('error', 'Error saving estimate calculations: ' . $e->getMessage());
        }

        return view('estimate.manager.item', compact('breakdown', 'estimate_info', 'id', 'subtotal', 'discount', 'tax', 'grandTotal', 'construction_list'));
    }

    public function updateDiscount(UpdateEstimateRequest $request, $id)
    {
        $validated = $request->validated();


        $estimate_info = $this->estimate->getEstimateById($id);

        if (!$estimate_info) {

            $estimate_info = new \stdClass();

        }

        $breakdown = $this->breakdown->breakdownByEstimateId($id);

        $totalAmount = $breakdown->sum('amount');

        $estimate_calculate = $this->estimateCalculate->createOrgetEstimateCalculate($id);

        $estimate_calculate->special_discount = $validated['special_discount'];

        $subtotal = $totalAmount - $estimate_calculate->special_discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        try {
            $this->estimateCalculate->estimateCalculateUpdate($estimate_calculate, $subtotal, $tax, $grandTotal);

            return redirect()->back()->with('success', 'Discount updated successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Error saving discount: ' . $e->getMessage()]);
        }
    }

    public function generateBreakdown($id)
    {
        return $this->pdfService->generateBreakdown($id);
    }

    public function generateCover($id)
    {
        return $this->pdfService->generateCover($id);
    }
}


