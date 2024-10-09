<?php

namespace App\Http\Controllers;


use App\Models\Manager;
use App\Models\Managerinfo;
use App\Models\EstimateInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Breakdown;
use App\Models\Estimate;
use Barryvdh\DomPDF\Facade\PDF;
use setasign\Fpdi\Tcpdf\Fpdi;
use TCPDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Mccarlosen\LaravelMpdf\Facades\Mpdf; // Make sure to import the correct namespace
use Mpdf\MpdfException; // Import the exception class for mPDF





class ManagerController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $estimate_info = EstimateInfo::query();

        if (!empty($keyword)) {
            $estimate_info = $estimate_info->where('creation_date', 'LIKE', "%{$keyword}%")
                ->orWhere('customer_name', 'LIKE', "%{$keyword}%")
                ->orWhere('construction_name', 'LIKE', "%{$keyword}%")
                ->orWhere('charger_name', 'LIKE', "%{$keyword}%")
                ->orWhere('department_name', 'LIKE', "%{$keyword}%")
                ->get();
        } else {
            $estimate_info = $estimate_info->get();
        }

        return view('manager_menu.estimate_index', compact('estimate_info', 'keyword'));
    }

    public function admin_index(Request $request)
    {
        $keyword = $request->input('search'); // Ensure you are getting the right input
        $manager_info = Admin::query();

        if (!empty($keyword)) {
            $manager_info = $manager_info->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%")
                ->orWhere('department_name', 'LIKE', "%{$keyword}%")
                ->get();
        } else {
            $manager_info = $manager_info->get();
        }

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

        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'department_name' => $validated['department_name'],
        ]);

        return redirect()->route('manager_menu')->with('success', '管理者が登録されました。');
    }

    //     public function edit($id)
// {
//     $admin = Admin::find($id);
//     return view('admins.edit', compact('admin'));
// }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admins.edit', [
            'admin' => $admin
        ]);
    }




    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id, // Ensure unique email but allow current one
            'password' => 'nullable|string|min:6', // Make password optional for update
            'department_name' => 'required|string|max:255',
        ]);

        // Update fields
        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        if ($validated['password']) { // Update password only if provided
            $admin->password = Hash::make($validated['password']);
        }
        $admin->department_name = $validated['department_name'];
        $admin->save();

        return redirect()->route('admins.index')->with('success', '管理者が更新されました。');
    }




    public function destroy($id)
    {
        //
    }

    public function show($id)
    {
        // Fetch the estimate info by ID
        $estimate_info = EstimateInfo::findOrFail($id);

        // Pass the estimate_info data to the view
        return view('manager_menu.show', ['estimate_info' => $estimate_info]);
    }

    public function itemView($id)
{
    // Fetch necessary data related to the $id (e.g., from Estimate or Breakdown models)
    $estimate_info = Estimate::find($id);



    $breakdown = Breakdown::where('estimate_id', $id)->get();

    // Calculate totals, etc.
    $subtotal = $breakdown->sum('amount');
    $discount = 0;
    $taxRate = 0.10;
    $tax = $subtotal * $taxRate;
    $grandTotal = $subtotal + $tax - $discount;

    // Pass all data to the view
    return view('manager_menu.item', compact('breakdown', 'estimate_info', 'id', 'subtotal', 'discount', 'tax', 'grandTotal'));
}


    public function breakdowns()
    {
        return $this->hasMany(Breakdown::class, 'estimate_id');
    }
    // to generate pdf


    // public function showpdf($id)
//     {
//         // Fetch the breakdown items associated with the given estimate ID
//         $breakdown = Breakdown::where('estimate_id', $id)->get();

    //         // Pass the breakdown and estimate ID to the view
//         return view('manager_menu.item', compact('breakdown', 'id as estimate_id')); // Pass the ID as estimate_id
//     }
// THis was previously made for VIEW PDF
    // public function generatePDF()
    // {
    //     // Fetch all breakdown data from the 'breakdown' table
    //     $breakdown = Breakdown::all(); // Retrieve all records

    //     // Calculate the total amount, discount, etc.
    //     $totalAmount = $breakdown->sum('amount'); // Sum of amounts
    //     $discount = 1000; // Example discount value
    //     $subtotal = $totalAmount - $discount; // Subtotal after discount
    //     $tax = $subtotal * 0.1; // 10% tax calculation
    //     $grandTotal = $subtotal + $tax; // Total after tax

    //     // Pass data to the PDF view
    //     $pdf = PDF::loadView('manager_menu.pdf', compact('breakdown', 'subtotal', 'tax', 'grandTotal', 'discount'))->setPaper('A4', 'portrait');

    //     // Return the generated PDF
    //     return $pdf->stream('item.pdf'); // Stream the PDF to the browser
    // }



    public function showEstimate($id)
    {
        // Retrieve the estimate by ID
        $estimate = Estimate::find($id);

        // Pass the estimate and its ID to the view
        return view('manager_estimate_index.estimate_index', [
            'estimate' => $estimate,
            'estimate_id' => $estimate->id // Ensure the ID is passed to the view
        ]);
    }


    // public function pdfget($id)
    // {
    //     // Retrieve the breakdown data for the given estimate_id (or however you want to relate it)
    //     $breakdown = Breakdown::where('estimate_id', $id)->get();

    //     // Pass the data to the view
    //     //    return view(view: 'manager_menu.item', compact('breakdown'));
    //     // Fetch breakdown data from the database
    //     // $breakdown = Breakdown::latest()->get();

    //     // Perform necessary calculations for the totals
    //     $subtotal = $breakdown->sum('amount');
    //     $discount = 0; // Assuming there's a discount, adjust this value as necessary
    //     $taxRate = 0.10; // 10% tax rate
    //     $tax = $subtotal * $taxRate;
    //     $grandTotal = $subtotal + $tax - $discount;

    //     // Pass the data to the Blade view and render it as a PDF
    //     $pdfView = view('manager_menu.pdftrail', [
    //         'id' => $id,
    //         'breakdown' => $breakdown,
    //         'subtotal' => $subtotal,
    //         'discount' => $discount,
    //         'tax' => $tax,
    //         'grandTotal' => $grandTotal
    //     ])->render();
    //     // Initialize mPDF
    //     $mpdf = new \Mpdf\Mpdf();

    //     // Enable auto language and font detection for Japanese text
    //     $mpdf->autoScriptToLang = true;
    //     $mpdf->autoLangToFont = true;

    //     // Write the rendered Blade HTML into the PDF
    //     $mpdf->WriteHTML($pdfView);

    //     // Output the PDF for download
    //     $mpdf->Output('Breakdown_Statement.pdf', dest: 'I'); // 'D' forces download
    // }





    //using tcpdf pacage but the fonts are not shown in japanese
    public function pdf($id)
{
    // Fetching the estimate info and breakdown based on the given ID
    $estimate_info = EstimateInfo::findOrFail($id);
    $breakdown = Breakdown::where('estimate_id', $id)->get();

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
    $pdf->Cell(0, 10, '工事名: ' . $estimate_info->construction_name, 0, 1);

    // Add header for the breakdown table
    $pdf->SetFillColor(220, 220, 220); // Set fill color for header background
    $pdf->Cell(25, 10, '工事項目', 1, 0, 'C', true); // Header for construction item
    $pdf->Cell(83, 10, '仕様', 1, 0, 'C', true); // Header for specification
    $pdf->Cell(15, 10, '数量', 1, 0, 'C', true); // Header for quantity
    $pdf->Cell(15, 10, '単位', 1, 0, 'C', true); // Header for unit
    $pdf->Cell(15, 10, '単価', 1, 0, 'C', true); // Header for unit price
    $pdf->Cell(20, 10, '金額', 1, 0, 'C', true); // Header for amount
    $pdf->Cell(25, 10, '備考', 1, 1, 'C', true); // Header for remarks

    // Loop through breakdown items and add data rows
    foreach ($breakdown as $item) {
        $pdf->Cell(25, 10, $item->construction_item, 1);
        $pdf->Cell(83, 10, $item->specification, 1);
        $pdf->Cell(15, 10, $item->quantity, 1);
        $pdf->Cell(15, 10, $item->unit, 1);
        $pdf->Cell(15, 10, number_format($item->unit_price), 1);
        $pdf->Cell(20, 10, number_format($item->amount), 1);
        $pdf->Cell(25, 10, $item->remarks, 1);
        $pdf->Ln();
    }

    // Calculate totals
    $totalAmount = $breakdown->sum('amount');
    $discount = 0; // Set your discount logic here
    $subtotal = $totalAmount - $discount;
    $tax = $subtotal * 0.1;
    $grandTotal = $subtotal + $tax;

    // Output totals below the breakdown table
    $pdf->Cell(153, 10, '小計（税抜）:', 1, 0, 'R');
    $pdf->Cell(20, 10, number_format($subtotal), 1, 1);
    $pdf->Cell(153, 10, '消費税（10%）:', 1, 0, 'R');
    $pdf->Cell(20, 10, number_format($tax), 1, 1);
    $pdf->Cell(153, 10, '合計（税込）:', 1, 0, 'R');
    $pdf->Cell(20, 10, number_format($grandTotal), 1, 1);

    // Output the PDF
    $pdf->Output("output.pdf", "I");
}



public function PDFshow($id)
{
    // Retrieve the estimate info by ID
    $estimate_info = EstimateInfo::findOrFail($id);

    // Generate the Blade view for the PDF
    $pdfView = view('tcpdf.breakdowndetail', compact('estimate_info'))->render();

    // Initialize mPDF for generating PDF
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4-P', // Landscape A4
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
    ]);

    // Write the rendered Blade HTML into the PDF
    $mpdf->WriteHTML($pdfView);

    // Output the PDF for download or inline view
    return $mpdf->Output('Estimate_Details.pdf', 'I');  // 'I' displays inline, 'D' forces download
}




    public function generatefpdi($id)
    {
        // Fetching the estimate info and breakdown based on the given ID
        $estimate_info = EstimateInfo::findOrFail($id);
        $breakdown = Breakdown::where('estimate_id', $id)->get();

        // Create new PDF document
        $pdf = new Fpdi("L", "mm", "A4", true, "UTF-8");
        $pdf->setPrintHeader(false);
        $pdf->AddPage();

        // Set the font
        $pdf->SetFont('cid0jp', '', 12); // Ensure the font is installed

        // Add title
        $pdf->Cell(0, 10, '内訳明細書', 0, 1, 'C');

        // Construction Name
        $pdf->Cell(0, 10, '工事名: ' . $estimate_info->construction_name, 0, 1);

        // Add header for the breakdown table
        $pdf->SetFillColor(220, 220, 220); // Set fill color for header background
        $pdf->Cell(40, 10, '工事項目', 1, 0, 'C', true); // Header for construction item
        $pdf->Cell(40, 10, '仕様', 1, 0, 'C', true); // Header for specification
        $pdf->Cell(30, 10, '数量', 1, 0, 'C', true); // Header for quantity
        $pdf->Cell(30, 10, '単位', 1, 0, 'C', true); // Header for unit
        $pdf->Cell(30, 10, '単価', 1, 0, 'C', true); // Header for unit price
        $pdf->Cell(30, 10, '金額', 1, 0, 'C', true); // Header for amount
        $pdf->Cell(30, 10, '備考', 1, 1, 'C', true); // Header for remarks

        // Loop through breakdown items and add data rows
        foreach ($breakdown as $item) {
            $pdf->Cell(40, 10, $item->construction_item, 1); // Border added
            $pdf->Cell(40, 10, $item->specification, 1); // Border added
            $pdf->Cell(30, 10, $item->quantity, 1); // Border added
            $pdf->Cell(30, 10, $item->unit, 1); // Border added
            $pdf->Cell(30, 10, number_format($item->unit_price), 1); // Border added
            $pdf->Cell(30, 10, number_format($item->amount), 1); // Border added
            $pdf->Cell(30, 10, $item->remarks, 1); // Border added
            $pdf->Ln(); // New line for next row
        }

        // Calculate totals
        $totalAmount = $breakdown->sum('amount');
        $discount = 0; // You can set your discount logic here
        $subtotal = $totalAmount - $discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;


        // Output totals below the breakdown table
        $pdf->Cell(170, 10, '小計（税抜）:', 1, 0, 'R'); // Right-aligned for better visual separation
        $pdf->Cell(30, 10, number_format($subtotal), 1, 1); // Separate cell for the subtotal
        $pdf->Cell(170, 10, '消費税（10%）:', 1, 0, 'R');
        $pdf->Cell(30, 10, number_format($tax), 1, 1); // Separate cell for the tax
        $pdf->Cell(170, 10, '合計（税込）:', 1, 0, 'R');
        $pdf->Cell(30, 10, number_format($grandTotal), 1, 1); // Separate cell for the grand total
        // Output the PDF
        $pdf->Output("output.pdf", "I");
    }

    public function showPdfTrail($id)
    {
        // Logic to show the PDF trail or download link based on the ID
        return view('pdf.trail', ['id' => $id]);
    }

}





