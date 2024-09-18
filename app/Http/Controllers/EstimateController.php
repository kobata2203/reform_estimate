<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstimateInfo;
use App\Models\ConstructionName;
use Illuminate\Support\Facades\DB;

class EstimateController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $estimate_info = EstimateInfo::all();


        /* キーワードから検索処理 */
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {//$keyword　が空ではない場合、検索処理を実行します
                          $estimate_info = EstimateInfo::where('creation_date', 'LIKE', "%{$keyword}%")
                          ->orwhere('customer_name', 'LIKE', "%{$keyword}%")
                          //->orwhere('construction_name', 'LIKE', "%{$keyword}%")
                          ->orwhere('charger_name', 'LIKE', "%{$keyword}%")
                          ->orwhere('department_name', 'LIKE', "%{$keyword}%")
                          ->get();
        }

    

        /* ページネーション */
        //$estimate_info ->paginate(5);

        //dd($estimate_info);
        return view('salesperson_menu.estimate_index', compact('estimate_info','keyword'));
    }



    public function create()
    {
        $construction_name = ConstructionName::all();

        return view('tcpdf.index', compact('construction_name'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        //$request->validate([
            //'creation_date' => 'required',
            //'customer_name' => 'required', //requiredは必須という意味です
            //'price' => 'required',
            //'charger_name' => 'required',
            //'subject_name' => 'required',
            //'delivery_place' => 'required',
            //'construction_period' => 'required',
            //'payment_type' => 'required',
        //]);

        $estimate_info = new EstimateInfo;
        //$estimate_info->id = $id->id;
        $estimate_info->creation_date = date("Y年m月d日");
        $estimate_info->customer_name = $request->customer_name;
        //$estimate_info->price = $request->price;
        $estimate_info->charger_name = $request->charger_name;
        $estimate_info->subject_name = $request->subject_name;
        $estimate_info->delivery_place = $request->delivery_place;
        $estimate_info->construction_period = $request->construction_period;
        $estimate_info->payment_type = $request->payment_type;
        $estimate_info->expiration_date = $request->expiration_date;
        $estimate_info->remarks = $request->remarks;
        $estimate_info->department_name = $request->department_name;
        //$estimate_info->construction_name = $request->construction_name;
        //$estimate_info->construction_item = $request->construction_item;
        //$estimate_info->specification = $request->specification;
        //$estimate_info->quantity = $request->quantity;
        //$estimate_info->unit = $request->unit;
        //$estimate_info->unit_price = $request->unit_price;
        //$estimate_info->amount = $request->amount;
        //$estimate_info->remarks2 = $request->remarks2;

        //$estimate_info = new EstimateInfo([
            //'id'=> 'id',
            //'creation_date' => today("Y年m月d日"),
            //'customer_name' => $request->input('customer_name'),
            //'price' => $request->input('price'),
            //'charger_name' => $request->input('charger_name'),
            //'subject_name' => $request->input('subject_name'),
            //'delivery_place' => $request->input('delivery_place'),
            //'construction_period' => $request->input('construction_period'),
            //'payment_type' => $request->input('payment_type'),
            //'expiration_date' => $request->input('expiration_date'),
            //'remarks' => $request->input('remarks'),
            //'department_name' => $request->input('department_name'),
            //'construction_name' => $request->input('construction_name'),
            //'construction_item' => $request->input('construction_item'),
            //'specification' => $request->input('specification'),
            //'quantity' => $request->input('quantity'),
            //'unit' => $request->input('unit'),
            //'unit_price' => $request->input('unit_price'),
            //'amount' => $request->input('amount'),
            //'remarks2' => $request->input('remarks2'),
        //]);
        //dd($estimate_info);
        $estimate_info->save();

        DB::commit();

        return redirect('estimate');

    }
}
