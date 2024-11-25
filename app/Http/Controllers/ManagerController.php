<?php

namespace App\Http\Controllers;


use TCPDF;
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
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdateEstimateRequest;
use App\Http\Requests\EstimateInfoRequest;


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
    }



    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $estimate_info = $this->estimateInfo->getEstimateInfo($keyword);
        
        return view('manager_menu.estimate_index')->with([
                    'estimate_info' => $this->estimateInfo->getEstimateInfo($keyword),  // Use the new model method
                    'keyword' => $keyword,
                    'departments' => $this->department->getDepartmentList(),
                    'construction_list' => $this->constructionList->findConnectionLists($estimate_info),
                ]);
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
        $totalAmount = $this->breakdown::getTotalAmountByEstimateId($id);
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

    public function pdf($id)
    {
        // Fetching the estimate info and breakdown based on the given ID
        $estimate_info = $this->estimateInfo->fetchEstimateInfoById($id);
        $breakdown = $this->breakdown->fetchBreakdownsByEstimateId($id);


        // Fetching the estimate calculation data based on the given estimate ID
        $estimate_calculation = $this->estimateCalculate->fetchCalculationByEstimateId($id);

        $discount = $estimate_calculation ? $estimate_calculation->special_discount : 0;
        // Create new PDF document
        $pdf = new TCPDF("P", "mm", "A4", true, "UTF-8");
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        // Set the font - ensure the font is installed and path is correct
        $pdf->AddFont('kozgopromedium', '', 'kozgopromedium.php'); // Adjust the path as necessary
        $pdf->SetFont('kozgopromedium', '', 12);

        // Title
        $pdf->Cell(0, 10, '内訳明細書', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->Cell(0, 10, '株式会社サーバントップ', 0, 1, 'R');
        $pdf->Ln(5);

        // Construction Name
        $pdf->Cell(0, 10, '工事名: ' . $estimate_info->construction_name, 0, 1);

        // Add header for the breakdown table
        $pdf->SetX(5);
        $pdf->SetFillColor(220, 220, 220); // Set fill color for header background
        $pdf->Cell(20, 10, '項目', 1, 0, 'C', true); // Header for construction item
        $pdf->Cell(70, 10, '仕様・摘要', 1, 0, 'C', true); // Header for specification
        $pdf->Cell(15, 10, '数量', 1, 0, 'C', true); // Header for quantity
        $pdf->Cell(10, 10, '単位', 1, 0, 'C', true); // Header for unit
        $pdf->Cell(15, 10, '単価', 1, 0, 'C', true); // Header for unit price
        $pdf->Cell(25, 10, '金額', 1, 0, 'C', true); // Header for amount
        $pdf->Cell(45, 10, '備考', 1, 1, 'C', true); // Header for remarks

        // Loop through breakdown items and add data rows
        $totalAmount = 0;
        foreach ($breakdown as $item) {
            $totalAmount += $item->amount;
            $pdf->SetX(5);
            $pdf->Cell(20, 10, $item->construction_item, 1, 0, 'C');
            $pdf->Cell(70, 10, $item->specification, 1, 0, 'C');
            $pdf->Cell(15, 10, $item->quantity, 1, 0, 'C');
            $pdf->Cell(10, 10, $item->unit, 1, 0, 'C');
            $pdf->Cell(15, 10, number_format($item->unit_price), 1, 0, 'C');
            $pdf->Cell(25, 10, '¥ ' . number_format($item->amount), 1, 0, 'C');
            $pdf->Cell(45, 10, $item->remarks, 1, 0, 'C');
            $pdf->Ln();
        }

        // Calculate totals
        $subtotal = $totalAmount - $discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        // Output totals below the breakdown table
        $pdf->SetX(5);
        $pdf->Cell(130, 10, '特別お値引き ', 1, 0, 'R');
        $pdf->Cell(25, 10, '¥ ' . number_format($discount), 1, 1, 'C');
        $pdf->SetX(5);
        $pdf->Cell(130, 10, '小計（税抜）', 1, 0, 'R');
        $pdf->Cell(25, 10, '¥ ' . number_format($subtotal), 1, 1, 'C');
        $pdf->SetX(5);
        $pdf->Cell(130, 10, '消費税（10%）', 1, 0, 'R');
        $pdf->Cell(25, 10, '¥ ' . number_format($tax), 1, 1, 'C');
        $pdf->SetX(5);
        $pdf->Cell(130, 10, '合計（税込）', 1, 0, 'R');
        $pdf->Cell(25, 10, '¥ ' . number_format($grandTotal), 1, 1, 'C');

        // Output the PDF
        $pdf->Output("output.pdf", "I");
    }

    public function PDFshow($id)
    {
        // Retrieve the estimate info by ID
        $estimate_info = $this->estimateInfo->fetchingEstimateInfoById($id);

        // Fetch related breakdown data for calculation
        $breakdown = $this->breakdown->fetchingBreakdownsByEstimateId($id);

        // Calculate the total amount
        $totalAmount = $breakdown->sum('amount');

        // Fetch the estimate calculation for discount
        $estimateCalculate = $this->estimateCalculate->fetchEstimateCalculateByEstimateId($id);
        $discount = $estimateCalculate ? $estimateCalculate->special_discount : 0;

        // Allow overriding the discount from the request
        $inputDiscount = request()->input('discount', $discount);

        // Discount and tax calculation
        $subtotal = $totalAmount - $inputDiscount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        // Generate the Blade view for the PDF
        $pdfView = view('tcpdf.breakdowndetail', compact('estimate_info', 'grandTotal', 'breakdown'))->render(); // Pass breakdown for detailed view

        // Initialize mPDF
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
        ]);

        $mpdf->WriteHTML($pdfView);

        return $mpdf->Output('Reform_Estimate_Details.pdf', 'I');
    }

}





