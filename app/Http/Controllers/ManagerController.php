<?php

namespace App\Http\Controllers;


use App\Models\Manager;
use App\Models\Managerinfo;
use App\Models\EstimateInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Breakdown;
use App\Models\Estimate;
use App\Models\EstimateCalculate;
use setasign\Fpdi\Tcpdf\Fpdi;
use TCPDF;




class ManagerController extends Controller
{
    protected $manager;
    protected $managerInfo;
    protected $estimateInfo;
    protected $admin;
    protected $breakdown;
    protected $estimate;
    protected $estimateCalculate;


    public function __construct()
{
    $this->manager = new Manager();
    $this->managerInfo = new Managerinfo();
    $this->estimateInfo = new EstimateInfo();
    $this->admin = new Admin();
    $this->breakdown = new Breakdown();
    $this->estimate = new Estimate();
    $this->estimateCalculate = new EstimateCalculate();
}

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $estimate_info = EstimateInfo::searchEstimateInfo($keyword);

        return view('manager_menu.estimate_index', compact('estimate_info', 'keyword'));
    }

    public function delete($id)
    {
        $estimate = $this->estimateInfo::findOrFail($id);
        $estimate->deleteEstimate();
        return redirect()->route('manager_estimate')->with('status', 'Data successfully hidden!');
    }

    public function admin_index(Request $request)
    {
        $keyword = $request->input('search'); // Ensure you are getting the right input


        $manager_info = Admin::searchAdmin($keyword);

        return view('admins.index', compact('manager_info'));
    }


    public function create()
    {
        return view('manager_index.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:6',
            'department_name' => 'required|string|max:255',
        ]);


        Admin::createAdmin($validated);


        return redirect()->route('manager_menu')->with('success', '管理者が登録されました。');
    }

    //     public function edit($id)
// {
//     $admin = Admin::find($id);
//     return view('admins.edit', compact('admin'));
// }

    public function edit($id)
    {
        $admin = Admin::findAdminById($id);
        return view('admins.edit', [
            'admin' => $admin
        ]);
    }




    public function update(Request $request, $id)
    {
        $admin = Admin::findAdminById($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id, // Ensure unique email but allow current one
            'password' => 'nullable|string|min:6', // Make password optional for update
            'department_name' => 'required|string|max:255',
        ]);

        // Use the updateAdmin method from the Admin model
        Admin::updateAdmin($admin, $validated);

        return redirect()->route('admins.index')->with('success', '管理者が更新されました。');
    }


    public function show($id)
    {
        // Fetch the estimate info and breakdown data
        list($estimate_info, $breakdown) = $this->estimateInfo->getEstimateWithDetails($id);

        // Calculate the total amount
        $totalAmount = $breakdown->sum('amount');

        // Fetch the discount using the EstimateCalculate model
        $discount = $this->estimateCalculate->getDiscountByEstimateId($id);

        $inputDiscount = request()->input('discount', $discount);

        // Calculate subtotal, tax, and grand total
        $subtotal = $totalAmount - $inputDiscount;
        $tax = $subtotal * 0.1; // Assuming 10% tax
        $grandTotal = $subtotal + $tax;

        // Pass the estimate_info, breakdown, and grandTotal to the view
        return view('manager_menu.show', [
            'estimate_info' => $estimate_info,
            'grandTotal' => $grandTotal,
            'discount' => $inputDiscount,
        ]);
    }



    public function itemView($id)
    {
        // Fetch necessary data related to the $id (from Estimate and Breakdown models)
        $estimate_info = $this->estimateInfo->getEstimateById($id); // Fetch the estimate record
        if (!$estimate_info) {
            return redirect()->back()->withErrors(['error' => 'Estimate not found']);
        }

        $breakdown = $this->breakdown->getBreakdownByEstimateId($id); // Fetch breakdown related to estimate

        // Calculate totalAmount from breakdown
        $totalAmount = $breakdown->sum('amount'); // Sum of all amounts

        // Fetch estimate_calculate record or create a new one if it doesn't exist
        $estimate_calculate = $this->estimateCalculate->getOrCreateEstimateCalculate($id); // Ensure estimate_id is set

        // Set special_discount, default to 0 if null
        $discount = $estimate_calculate->special_discount ?? 0;

        // Perform calculations
        $subtotal = $totalAmount - $discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        // Save or update the estimate_calculate record
        try {
            $this->estimateCalculate->updateEstimateCalculate($estimate_calculate, $subtotal, $tax, $grandTotal);
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle any errors during save
            return redirect()->back()->withErrors(['error' => 'Error saving estimate calculations: ' . $e->getMessage()]);
        }

        // Pass all data to the view
        return view('manager_menu.item', compact('breakdown', 'estimate_info', 'id', 'subtotal', 'discount', 'tax', 'grandTotal'));
    }


    public function updateDiscount(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'special_discount' => 'required|numeric|min:0', // Ensure it's a valid number
        ]);

        // Fetch the estimate
        $estimate_info = $this->estimate->getEstimateById($id);
        if (!$estimate_info) {
            return redirect()->back()->withErrors(['error' => 'Estimate not found']);
        }

        // Fetch related breakdown data
        $breakdown = $this->breakdown->breakdownByEstimateId($id);

        // Calculate the total amount from the breakdown
        $totalAmount = $breakdown->sum('amount'); // Sum amounts directly

        // Fetch the estimate_calculate record or create a new one
        $estimate_calculate = $this->estimateCalculate->createOrgetEstimateCalculate($id);

        // Update the discount from the form input
        $estimate_calculate->special_discount = $request->input('special_discount');

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

    // public function showEstimate($id)
    // {
    //     // Retrieve the estimate by ID
    //     $estimate = $this->estimate::find($id);

    //     // Pass the estimate and its ID to the view
    //     return view('manager_estimate_index.estimate_index', [
    //         'estimate' => $estimate,
    //         'estimate_id' => $estimate->id // Ensure the ID is passed to the view
    //     ]);
    // }

    //using tcpdf pacage but the fonts are not shown in japanese
    public function pdf($id)

    {
        // Fetching the estimate info and breakdown based on the given ID
        $estimate_info = $this->estimateInfo->fetchEstimateInfoById($id);
        $breakdown = $this->breakdown->fetchBreakdownsByEstimateId($id);

        $estimate = $this->estimate->fetchEstimateWithCalculations($id);
        // Create new PDF document
        $pdf = new TCPDF("P", "mm", "A4", true, "UTF-8");
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        // Set the font - ensure the font is installed and path is correct
        $pdf->AddFont('kozgopromedium', '', 'kozgopromedium.php'); // Adjust the path as necessary
        $pdf->SetFont('kozgopromedium', '', 12);

        $pdf->SetFillColor(220, 220, 220);
        // Add title


        $pdf->Cell(0, 10, '内訳明細書', 0, 1, 'C');
        $pdf->Ln(5);


        $pdf->Cell(0,10, '株式会社サーバントップ',0, 1, 'R');

        $pdf->Ln(5);
        // Construction Name

        // dd($estimate->toArray());
        $pdf->Cell(0, 10, '工事名: ' . $estimate_info->construction_name, 0, 1);


        // Add header for the breakdown table
        $pdf->SetX(5);
        $pdf->SetFillColor(220, 220, 220); // Set fill color for header background
        $pdf->Cell(20, 10, '工事項目', 1, 0, 'C', true); // Header for construction item
        $pdf->Cell(70, 10, '仕様', 1, 0, 'C', true); // Header for specification
        $pdf->Cell(15, 10, '数量', 1, 0, 'C', true); // Header for quantity
        $pdf->Cell(10, 10, '単位', 1, 0, 'C', true); // Header for unit
        $pdf->Cell(15, 10, '単価', 1, 0, 'C', true); // Header for unit price
        $pdf->Cell(25, 10, '金額', 1, 0, 'C', true); // Header for amount
        $pdf->Cell(45, 10, '備考', 1, 1, 'C', true); // Header for remarks

        // Loop through breakdown items and add data rows
        foreach ($breakdown as $item) {
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
        $totalAmount = $breakdown->sum('amount');
        $discount = $estimate->calculate->special_discount;
        $subtotal = $totalAmount - $discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        // Output totals below the breakdown table
        $pdf->SetX(5);
        $pdf->Cell(130,10, '特別お値引き ',1, 0, 'R');
        $pdf->Cell(25, 10,'¥ ' . number_format($discount), 1, 1, 'C');
        $pdf->SetX(5);
        $pdf->Cell(130, 10, '小計（税抜）', 1, 0, 'R');
        $pdf->Cell(25, 10,'¥ ' . number_format($subtotal),1, 1, 'C');
        $pdf->SetX(5);
        $pdf->Cell(130, 10, '消費税（10%）',1, 0, 'R');
        $pdf->Cell(25, 10,'¥ ' . number_format($tax),1, 1, 'C');
        $pdf->SetX(5);
        $pdf->Cell(130, 10, '合計（税込）', 1, 0, 'R');
        $pdf->Cell(25, 10,'¥ ' . number_format($grandTotal),1, 1, 'C');

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

    return $mpdf->Output('Estimate_Details.pdf', 'I');
}

}





