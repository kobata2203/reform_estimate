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
        $estimate_info = EstimateInfo::all();


        /* キーワードから検索処理 */
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {//$keyword　が空ではない場合、検索処理を実行します
                          $estimate_info = EstimateInfo::where('creation_date', 'LIKE', "%{$keyword}%")
                          ->orwhere('customer_name', 'LIKE', "%{$keyword}%")
                          ->orwhere('construction_name', 'LIKE', "%{$keyword}%")
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
        return view('tcpdf.index');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'creation_date' => 'required',
            'customer_name' => 'required', //requiredは必須という意味です
            'price' => 'required',
            'charger_name' => 'required',
            'subject_name' => 'required',
            'delivery_place' => 'required',
            'construction_period' => 'required',
            'payment_type' => 'required',
        ]);

        $estimate_info = new EstimateInfo([
            'id',
            'creation_date' => today("Y年m月d日"),
            'customer_name' => $request->input('customer_name'),
            'price' => $request->input('price'),
            'charger_name' => $request->input('charger_name'),
            'subject_name' => $request->input('subject_name'),
            'delivery_place' => $request->input('delivery_place'),
            'construction_period' => $request->input('construction_period'),
            'payment_type' => $request->input('payment_type')
        ]);
        //dd($estimate_info);
        $estimate_info->save();

        DB::commit();

        return redirect();

    }
}
