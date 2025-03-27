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
use App\Models\EstimateCalculate;

class BreakdownController extends Controller
{
    protected $estimate;
    protected $construction;
    protected $construction_item;
    protected $breakdown;
    protected $department;
    protected $payment;
    protected $construction_name;
    protected $construction_list;
    protected $estimate_info;
    protected $estimate_calculate;

    /**
     * 初期処理
     * 使用するクラスのインスタンス化
     */
    public function __construct(
        EstimateInfo $estimate_info,
        ConstructionList $construction_list,
        ConstructionName $construction_name,
        ConstructionItem $construction_item,
        Breakdown $breakdown,
        Department $department,
        Payment $payment,
        EstimateCalculate $estimate_calculate
    ) {
        $this->estimate_info = $estimate_info;
        $this->construction_list = $construction_list;
        $this->construction_name = $construction_name;
        $this->construction_item = $construction_item;
        $this->breakdown = $breakdown;
        $this->department = $department;
        $this->payment = $payment;
        $this->estimate_calculate = $estimate_calculate;
    }

    public function create($id, Request $request)
    {
        $construction_list = $this->construction_list::find($request->cid);
        $estimate_info = $this->estimate_info::find($construction_list->estimate_info_id);

        $breakdown_store_routing = route('breakdown.store');

        /**
         * SQLはモデルに記載する
         */
        $breakdown_items = $this->breakdown->getBreakdownList($request->cid);
        $construction_id = $this->construction_name->getByCconstructionName($construction_list->name);

        if (count($breakdown_items) == 0) {
            if (empty($construction_id)) {
                $breakdown_items = $this->breakdown->setDummyData();
            } else {
                $breakdown_items = $this->construction_item->getItemsByConstractionId($construction_id);
            }
        } elseif (!empty($request->old('estimate_id'))) { // セッションの存在確認
            $breakdown_items = $this->breakdown->setDummyData($request->old());
        }
        return view('breakdown.create')->with([
            'id' => $id,
            'cid' => $request->cid,
            'estimate_info' => $estimate_info,
            'breakdown_items' => $breakdown_items,
            'construction_id' => $construction_id,
            'breakdown_store_routing' => $breakdown_store_routing,
        ]);
    }

    /**
     * 登録処理
     * @param BreakdownRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BreakdownRequest $request)
    {
        $regist_breakdown = $this->breakdown->registBreakdown($request);

        if ($regist_breakdown === true) {
            $message = config('message.regist_complete');
        } else {
            $message = config('message.regist_fail');
        }

        return redirect('estimate/index')->with([
            'message' => $message,
        ]);
    }

}
