<?php

namespace App\Http\Controllers;

use App\Models\ConstructionList;
use App\Models\Estimate;
use Illuminate\Http\Request;
use App\Models\EstimateInfo;
use App\Models\ConstructionName;
use App\Models\ConstructionItem;
use App\Models\Breakdown;
use App\Models\Department;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BreakdownRequest;
use App\Http\Requests\EstimateInfoRequest;

class ManagerBreakdownController extends Controller
{
    protected $estimate;
    protected $construction;
    protected $constructionItem;
    protected $breakdown;
    protected $department;
    protected $payment;
    protected $constructionName;
    protected $constructionList;

    /**
     * 初期処理
     * 使用するクラスのインスタンス化
     */
    public function __construct(
        EstimateInfo $estimateInfo,
        ConstructionList $constructionList,
        ConstructionName $constructionName,
        ConstructionItem $constructionItem,
        Breakdown $breakdown,
        Department $department,
        Payment $payment,
    )
    {
        $this->estimateInfo = $estimateInfo;
        $this->constructionList = $constructionList;
        $this->constructionName = $constructionName;
        $this->constructionItem = $constructionItem;
        $this->breakdown = $breakdown;
        $this->department = $department;
        $this->payment = $payment;
    }

    public function create($id, Request $request)
    {
        $construction_list = $this->constructionList::find($id);
        $estimate_info = $this->estimateInfo::find($construction_list->estimate_info_id);
        $construction_name = $this->constructionName::find($construction_list->estimate_info_id);
        $prevurl = url()->previous(); // 直前のページURLを取得、取得できない場合はデフォルト値を設定

        /**
         * SQLはモデルに記載する
         */
        $breakdown_items = $this->breakdown->getBreakdownList($construction_list->estimate_info_id);
        $construction_id = $this->constructionName->getByCconstructionName($construction_list->name);
        
        if(count($breakdown_items) == 0) {
            if(empty($construction_id)) {
                $breakdown_items = $this->breakdown->setDummyData();
            } else {
                $breakdown_items = $this->constructionItem->getItemsByConstractionId($construction_id);
                //dd($breakdown_items);
            }
        } elseif(!empty($request->old('estimate_id'))) { // セッションの存在確認
            $breakdown_items = $this->breakdown->setDummyData($request->old());
        }
        //dd($breakdown_items);
        return view('breakdown.manager.create')->with([
            'id' => $id,
            'estimate_info' => $estimate_info,
            'construction_name' => $construction_name,
            'breakdown_items' => $breakdown_items,
            'prevurl' => $prevurl,
            'construction_id' => $construction_id
        ]);
    }

    /**
     * 登録処理
     * @param BreakdownRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BreakdownRequest $request)
    {
        $prevurl = $request->prevurl;

        //直前のページURLが一覧画面（パラメータ有）ではない場合
        if(false === strpos($prevurl, 'estimate_info?')){
            $prevurl = url('utill.prevurl_manager_breakdown_store');	//一覧画面のURLを直接指定
        }

        $regist_breakdown = $this->breakdown->registBreakdown($request);

        if($regist_breakdown === true) {
            $message = config('message.regist_complete');
        } else {
            $message = config('message.regist_fail');
        }

        return redirect('manager_estimate')->with([
            'message' => $message,
            'prevurl' => $prevurl,
        ]);
    }
}