<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstimateInfo;
use App\Models\ConstructionName;
use Illuminate\Support\Facades\DB;
use App\Models\Breakdown;

class EstimateController extends Controller
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

        return view('salesperson_menu.estimate_index', compact('estimate_info', 'keyword'));
    }

    public function create()
    {
        $construction_name = ConstructionName::all();

        return view('tcpdf.index', compact('construction_name'));
    }


    public function breakdown_create($id)
    {
        $estimate_info = EstimateInfo::find($id);

        if (!$estimate_info) {
            return redirect()->route('estimate')->with('error', 'Estimate not found.');
        }
    // get by id From Breakdown
    $datalis=[

    ];

        return view('tcpdf.breakdown_index', [
        // 'datalist'=>
            'estimate_info' => $estimate_info,
            'id' => $id,
            // 'construction_id' =>
        ]);
    }

    public function breakdown_store(Request $request)
{
    DB::beginTransaction();


    try {
        // Validate incoming data
        $validatedData = $request->validate([
            'construction_item' => 'required|string',
            'specification' => 'nullable|string',
            'quantity' => 'required|numeric',
            'unit' => 'nullable|string',
            'unit_price' => 'required|numeric',
            'amount' => 'required|numeric',
            'remarks2' => 'nullable|string',
            'estimate_id' => 'required|exists:estimate_info,id', // Ensure the estimate ID exists
            'construction_id' => 'required|exists:construction_names,id' // Ensure the construction ID exists
        ]);

        // Fetch the specific EstimateInfo and ConstructionName records
        $estimate_info = EstimateInfo::findOrFail($validatedData['estimate_id']);
        $construction_name = ConstructionName::findOrFail($validatedData['construction_id']);

        // Create a new Breakdown record
        $breakdown = new Breakdown();
        $breakdown->estimate_id = $estimate_info->id; // Use the retrieved estimate info
        $breakdown->construction_id = $construction_name->id; // Use the retrieved construction name
        $breakdown->construction_item = $validatedData['construction_item'];
        $breakdown->specification = $validatedData['specification'];
        $breakdown->quantity = $validatedData['quantity'];
        $breakdown->unit = $validatedData['unit'];
        $breakdown->unit_price = $validatedData['unit_price'];
        $breakdown->amount = $validatedData['amount'];
        $breakdown->remarks2 = $validatedData['remarks2'];

        // Save the breakdown
        $breakdown->save();

        DB::commit();

        return redirect('estimate')->with('success', 'Data saved successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        echo $e->getMessage();
   die();
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}


public function showBreakdownForm($id)
{
    $estimate_info = EstimateInfo::findOrFail($id);
    $construction_names = ConstructionName::all(); // Get all construction names

    return view('tcpdf.breakdown_index', compact('estimate_info', 'construction_names'));
}

    public function store(Request $request)
    {
        DB::beginTransaction();

        //$request->validate([
        //'customer_name' => 'required',
        //'creation_date' => 'required',
        //'subject_name' => 'required',
        //'delivery_place' => 'required',
        //'construction_period' => 'required',
        //'payment_type' => 'required',
        //]);

        //$construction_id = $request->input('contruction_id');

        $estimate_info = new EstimateInfo();
        //$estimate_info->$id = id();
        $estimate_info->creation_date = date("Y年m月d日");
        $estimate_info->customer_name = $request->customer_name;
        $estimate_info->subject_name = $request->subject_name;
        $estimate_info->delivery_place = $request->delivery_place;
        $estimate_info->construction_period = $request->construction_period;
        $estimate_info->payment_type = $request->payment_type;
        $estimate_info->expiration_date = $request->expiration_date;
        $estimate_info->remarks = $request->remarks;
        $estimate_info->charger_name = $request->charger_name;
        $estimate_info->department_name = $request->department_name;
        //$estimate_info->construction_id = $request->construction_id;
        //$estimate_info->construction_id = $construction_id;
        $estimate_info->construction_name = $request->construction_name;

        //$estimate_info = EstimateInfo::create([
        //'creation_date' => date('y年m月d日'),
        //'customer_name' => $request->get('customer_name'),
        //'subject_name' => $request->get('subject_name'),
        //'delivery_place' => $request->get('delivery_place'),
        //'construction_period' => $request->get('construction_period'),
        //'payment_type' => $request->get('payment_type'),
        //'expiration_date' => $request->get('expiration_date'),
        //'remarks' => $request->get('remarks'),
        //'charger_name' => $request->get('charger_name'),
        //'department_name' => $request->get('department_name'),
        //'construction_name' => $request->get('construction_name'),
        //'construction_item' => $request->get('construction_item'),
        //'specification' => $request->get('specification'),
        //'quantity' => $request->get('quantity'),
        //'unit' => $request->get('unit'),
        //'unit_price' => $request->get('unit_price'),
        //'amount' => $request->get('amount'),
        //'remarks2' => $request->get('remarks2'),
        //]);
        //dd($estimate_info);
        $estimate_info->save();

        DB::commit();

        return redirect('estimate');
    }

    public function indexView()
    {
        $estimates = EstimateInfo::with('breakdowns')->get();
        return view('estimate.index', compact('estimates'));
    }

    // public function show($id)
    // {
    //     // Fetch the breakdown record using the provided ID
    //     $table  = EstimateInfo::findOrFail($id); // Make sure to handle this properly if the record doesn't exist

    //     // Return the view with breakdown data
    //     return view('manager_menu.show', compact('breakdown'));
    // }


}
