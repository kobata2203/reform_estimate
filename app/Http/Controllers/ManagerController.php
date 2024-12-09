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
        $keyword = $request->input('keyword');
        $estimate_info = $this->estimateInfo->getEstimateInfo($keyword);

        return view('manager_menu.estimate_index')->with([
            'estimate_info' => $this->estimateInfo->getEstimateInfo($keyword),
            'keyword' => $keyword,
            'departments' => $this->department->getDepartmentList(),
            'construction_list' => $this->constructionList->getConnectionLists($estimate_info),
        ]);
    }

    public function delete($id)
    {
        $this->estimateInfo->deleteEstimate($id);
        return redirect()->route('manager_estimate')->with('status', config('message.delete_complete'));
    }

    public function admin_index(Request $request)
    {
        $keyword = $request->input('search');
        $manager_info = $this->admin->searchAdmin($keyword);
        return view('admins.index', compact('manager_info'));
    }

    public function create()
    {
        return view('manager_index.create');
    }

    public function store(CreateAdminRequest $request)
    {
        $validated = $request->validated();
        $this->admin->createAdmin($validated);
        return redirect()->route('manager_menu')->with('success', config('message.regist_complete'));
    }

    public function edit($id)
    {
        $admin = $this->admin->findAdminById($id);
        return view('admins.edit', [
            'admin' => $admin
        ]);
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        $validated = $request->validated();

        $this->admin->updateAdmin($id, $validated);

        return redirect()->route('admins.index')->with('success', config('message.update_complete'));
    }

    public function show($id)
    {
        $estimate_info = $this->estimateInfo::getEstimateByIde($id);
        $totalAmount = $this->breakdown::getTotalAmountByEstimateId($id);
        $discount = $this->estimateCalculate::getDiscountByEstimateId($id);
        $inputDiscount = request()->input('discount', $discount);
        // Calculate subtotal, tax, and grand total
        $subtotal = $totalAmount - $inputDiscount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        // Fetch related construction names for this estimate
        $construction_list = $this->constructionList->getConnectionLists([$estimate_info]);
        //forpayment
        $estimate_info = $this->estimateInfo::with('payment')->findOrFail($id);

        // Pass the estimate_info, breakdown, and grandTotal to the view
        return view('manager_menu.show', [
            'estimate_info' => $estimate_info,
            'grandTotal' => $grandTotal,
            'discount' => $inputDiscount,
            'construction_list' => $construction_list[$estimate_info->id] ?? []
        ]);
    }

    //for displaying the data from the breakdown tbl in the estimate_info tbl section
    public function itemView($id)
    {
        // Fetch the estimate record or use null if not found
        $estimate_info = $this->estimateInfo->getById($id);

        //calling the construction_name from the ConstructionList
        $construction_list = $this->constructionList->getById($id);

        // Fetch breakdown related to estimate or use an empty collection if no estimate is found
        $breakdown = $estimate_info ? $this->breakdown->getByEstimateId($id) : collect([]);

        // Calculate total amount from breakdown
        $totalAmount = $breakdown->sum('amount') ?? 0;

        // Fetch or create an estimate_calculate record related to this estimate
        $estimate_calculate = $this->estimateCalculate->getOrCreateByEstimateId($id);

        // Set discount to 0 if null, handle calculations even if no data is found
        $discount = $estimate_calculate->special_discount ?? 0;
        $subtotal = $totalAmount - $discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        // Save or update the estimate_calculate record with the new values
        $estimate_calculate->estimate_id = $id;
        $estimate_calculate->special_discount = $discount;

        try {
            $estimate_calculate->updateCalculations($subtotal, $tax, $grandTotal);
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle any save errors
            session()->flash('error', 'Error saving estimate calculations: ' . $e->getMessage());
        }


        return view('manager_menu.item', compact('breakdown', 'estimate_info', 'id', 'subtotal', 'discount', 'tax', 'grandTotal', 'construction_list'));
    }

    public function updateDiscount(UpdateEstimateRequest $request, $id)
    {
        $validated = $request->validated();

        // Fetch the estimate
        $estimate_info = $this->estimate->getEstimateById($id);

        if (!$estimate_info) {
            // Set default values or handle logic when the estimate is not found
            $estimate_info = new \stdClass();

        }
        // Fetch related breakdown data
        $breakdown = $this->breakdown->breakdownByEstimateId($id);

        // Calculate the total amount from the breakdown
        $totalAmount = $breakdown->sum('amount'); // Sum amounts directly

        // Fetch the estimate_calculate record or create a new one
        $estimate_calculate = $this->estimateCalculate->createOrgetEstimateCalculate($id);

        // Update the discount from the form input
        $estimate_calculate->special_discount = $validated['special_discount'];

        // Recalculate subtotal, tax, and total
        $subtotal = $totalAmount - $estimate_calculate->special_discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        try {
            // Update the estimate_calculate record with the new values
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





