<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstimateInfo;
use App\Models\ConstructionName;
use App\Models\Breakdown;
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
        $construction_name = ConstructionName::all();

        return view('tcpdf.index',compact('construction_name'));
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

        $estimate_info->save();

        DB::commit();

        return redirect('estimate');
    }

    public function breakdown_create()
    {
        return view('tcpdf.breakdown_index');
    }

    public function breakdown_store(Request $request)
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

        $breakdown = new Breakdown();
        //$estimate_info->$id = id();
        //$breakdown->estimate_id = estimate_info_id();
        //$breakdown->construction_id = construction_name_id();
        $breakdown->construction_item = $request->construction_item;
        $breakdown->specification = $request->specification;
        $breakdown->quantity = $request->quantity;
        $breakdown->unit = $request->unit;
        $breakdown->unit_price = $request->unit_price;
        $breakdown->amount = $request->amount;
        $breakdown->remarks2 = $request->remarks2;


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

        $breakdown->save();

        DB::commit();

        return redirect('estimate');
    }
}
