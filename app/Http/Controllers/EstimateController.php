<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstimateInfo;
use Illuminate\Support\Facades\DB;

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
        return view('salesperson_menu.estimate_index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'creation_date' => 'required|date',
            'subject_name' => 'required',
            'delivery_place' => 'required',
            'construction_period' => 'required',
            'payment_type' => 'required',
        ]);

        $estimate_info = EstimateInfo::create([
            'customer_name' => $request->get('customer_name'),
            'creation_date' => $request->get('creation_date'),
            'subject_name' => $request->get('subject_name'),
            'delivery_place' => $request->get('delivery_place'),
            'construction_period' => $request->get('construction_period'),
            'payment_type' => $request->get('payment_type'),
            'expiration_date' => $request->get('expiration_date'),
            'remarks' => $request->get('remarks'),
            'charger_name' => $request->get('charger_name'),
            'department_name' => $request->get('department_name'),
            'construction_name' => $request->get('construction_name'),
            'construction_item' => $request->get('construction_item'),
            'specification' => $request->get('specification'),
            'quantity' => $request->get('quantity'),
            'unit' => $request->get('unit'),
            'unit_price' => $request->get('unit_price'),
            'amount' => $request->get('amount'),
            'remarks2' => $request->get('remarks2'),
        ]);

        return redirect()->route('estimate.index');
    }
}
