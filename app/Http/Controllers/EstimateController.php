<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstimateInfo;
use App\Models\ConstructionName;
use App\Models\ConstructionItem;
use App\Models\Breakdown;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BreakdownRequest;

class EstimateController extends Controller
{
    /**
     * 初期処理
     * 使用するクラスのインスタンス化
     */
  

     public function __construct()
    {
        $this->estimateInfo = new EstimateInfo();
        $this->constructionName = new ConstructionName();
        $this->constructionItem = new ConstructionItem();
        $this->breakdown = new Breakdown();
    }
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $estimate_info = $this->estimateInfo::query();
        // $estimate_info = EstimateInfo::query();

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
        $construction_name = $this->constructionName->get_target_construction_name();
        return view('cover.index',compact('construction_name'));
    }
    /**
     * 登録処理
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request,ConstructionName $construction_name)
    {
        $regist_estimate_info = $this->estimateInfo->regist_estimate_info($request);

        if($regist_estimate_info === true) {
            $message = config('message.regist_complete');
        } else {
            $message = config('message.regist_fail');
        }

        return redirect('estimate/index')->with('message', $message);
    }

    public function breakdown_create(EstimateInfo $estimate_info,ConstructionName $construction_name ,$id)
    {
        $estimate_info = $this->estimateInfo::find($id);
        $construction_name = $this->constructionName::find($id);
        $prevurl = url()->previous();

        /**
         * SQLはモデルに記載する
         */
        $construction_items = $this->constructionItem->get_target_items($estimate_info->construction_id);

        return view('breakdown.breakdown_create')->with([
            'id' => $id,
            'estimate_info' => $estimate_info,
            'construction_name' => $construction_name,
            'construction_loop_count' => $construction_name->loop_count,
            'construction_items' => $construction_items,
            'prevurl' => $prevurl,
        ]);
    }

    /**
     * 登録処理
     * @param BreakdownRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function breakdown_store(BreakdownRequest $request)
    {
        $prevurl = $request->prevurl;

        //直前のページURLが一覧画面（パラメータ有）ではない場合
        if(false === strpos($prevurl, 'estimate_info?')){
            $prevurl = url('/salesperson_menu/index');	//一覧画面のURLを直接指定
        }

        $regist_breakdown = $this->breakdown->regist_breakdown($request);

        if($regist_breakdown === true) {
            $message = config('message.regist_complete');
        } else {
            $message = config('message.regist_fail');
        }

        return redirect('estimate')->with('message', $message);
    }

    public function indexView()
    {
        $estimates = $this->estimateInfo::with('breakdowns')->get();
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
