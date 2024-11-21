<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Manager;
use App\Models\Estimate;
use App\Models\Breakdown;
use App\Models\Managerinfo;
use App\Models\EstimateInfo;
use Illuminate\Http\Request;
use App\Models\EstimateCalculate;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdateEstimateRequest;
use App\Services\CoverService;
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
    protected $coverService;
    protected $pdfService;

    public function __construct(

        Manager $manager,
        Managerinfo $managerInfo,
        EstimateInfo $estimateInfo,
        Admin $admin,
        Breakdown $breakdown,
        Estimate $estimate,
        EstimateCalculate $estimateCalculate,
        CoverService $coverService,
        PdfService $pdfService
    ) {
        $this->manager = $manager;
        $this->managerInfo = $managerInfo;
        $this->estimateInfo = $estimateInfo;
        $this->admin = $admin;
        $this->breakdown = $breakdown;
        $this->estimate = $estimate;
        $this->estimateCalculate = $estimateCalculate;
        $this->coverService = $coverService;
        $this->pdfService = $pdfService;
    }

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $estimate_info = $this->estimateInfo->getEstimateInfo($keyword);
        return view('manager_menu.estimate_index', compact('estimate_info', 'keyword'));
    }

    public function delete($id)
    {
        $this->estimateInfo->deleteEstimate($id);
        return redirect()->route('manager_estimate')->with('status', 'Data successfully hidden!');
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
        return redirect()->route('manager_menu')->with('success', '管理者が登録されました。');
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

        return redirect()->route('admins.index')->with('success', '管理者が更新されました。');
    }

    public function show($id)
    {
        $estimate_info = $this->estimateInfo::getEstimateByIde($id);
        // $totalAmount = $this->breakdown::getTotalAmountByEstimateId($id);
        $breakdown = new Breakdown();
        $totalAmount = $breakdown->getTotalAmountByEstimateId($id);
        $discount = $this->estimateCalculate::getDiscountByEstimateId($id);
        $inputDiscount = request()->input('discount', $discount);
        // Calculate subtotal, tax, and grand total
        $subtotal = $totalAmount - $inputDiscount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;
        // Pass the estimate_info, breakdown, and grandTotal to the view
        return view('manager_menu.show', [
            'estimate_info' => $estimate_info,
            'grandTotal' => $grandTotal,
            'discount' => $inputDiscount
        ]);
    }

    //for displaying the data from the breakdown tbl in the estimate_info tbl section
    public function itemView($id)
    {
        // Fetch the estimate record or use null if not found
        $estimate_info = $this->estimateInfo->getById($id);

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

        return view('manager_menu.item', compact('breakdown', 'estimate_info', 'id', 'subtotal', 'discount', 'tax', 'grandTotal'));
    }

    //method before service class
    public function updateDiscount(UpdateEstimateRequest $request, $id)
    {
        $validated = $request->validated();

        // Fetch the estimate
        $estimate_info = $this->estimate->getEstimateById($id);

        if (!$estimate_info) {
            $estimate_info = new \stdClass();

        }

        $breakdown = $this->breakdown->getBreakdownsByEstimateId($id);


        $totalAmount = $breakdown->sum('amount');

        $estimate_calculate = $this->estimateCalculate->createOrgetEstimateCalculate($id);

        $estimate_calculate->special_discount = $validated['special_discount'];

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

    //showing breakdown with mpdf without Service class
    public function pdf($id)
    {
        // Fetching the estimate info and breakdown based on the given ID
        $estimate_info = $this->estimateInfo->fetchEstimateInfoById($id);
        $breakdown = $this->breakdown->getBreakdownsByEstimateId($id);

        // Fetching the estimate calculation data based on the given estimate ID
        $estimate_calculation = $this->estimateCalculate->fetchCalculationByEstimateId($id);

        $discount = $estimate_calculation ? $estimate_calculation->special_discount : 0;

        // Calculate totals
        $totalAmount = 0;
        foreach ($breakdown as $item) {
            $totalAmount += $item->amount;
        }
        $subtotal = $totalAmount - $discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        // Render the Blade view to HTML
        $html = view('tcpdf.breakdown', compact('estimate_info', 'breakdown', 'discount', 'totalAmount', 'subtotal', 'tax', 'grandTotal'))->render();


        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
        ]);

        // Add the necessary font for Japanese characters (you can use a font like IPA or Noto Sans)
        $mpdf->SetFont('ipaexg');

        // Write the HTML to the PDF
        $mpdf->WriteHTML($html);
        $mpdf->Output('estimate.pdf', 'I');
    }

    // after making service class
    public function PDFshow($id, Request $request)
    {
        // Retrieve data using service methods
        $estimateInfo = $this->coverService->getEstimateInfoById($id);
        $breakdown = $this->coverService->getBreakdownsByEstimateId($id);
        $estimateCalculate = $this->coverService->getEstimateCalculation($id);

        // Allow overriding discount from request
        $discount = $request->input('discount', $estimateCalculate?->special_discount ?? 0);

        // Perform calculations
        $totals = $this->coverService->calculateTotals($breakdown, $discount);

        // Generate PDF
        return $this->coverService->generatePDF($estimateInfo, $totals['grandTotal'], $breakdown);
    }


}





