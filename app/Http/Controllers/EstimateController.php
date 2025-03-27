<?php

namespace App\Http\Controllers;

use App\Models\ConstructionList;
use Illuminate\Http\Request;
use App\Models\EstimateInfo;
use App\Models\ConstructionName;
use App\Models\ConstructionItem;
use App\Models\Breakdown;
use App\Models\Department;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EstimateInfoRequest;


class EstimateController extends Controller
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

    protected $estimate_init_count = 1; // 工事名の初期表示数
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
    ) {
        $this->estimate_info = $estimate_info;
        $this->construction_list = $construction_list;
        $this->construction_name = $construction_name;
        $this->construction_item = $construction_item;
        $this->breakdown = $breakdown;
        $this->department = $department;
        $this->payment = $payment;
        $this->estimate_info = $estimate_info;
    }


    public function index(Request $request)
    {
        // 見積書一覧の取得
        $keyword = $request->input('keyword');
        $estimate_info = $this->estimate_info->getEstimateInfo($keyword);
        $construction_list = $this->construction_list->getConnectionLists($estimate_info);

        $breakdown_create_routing = 'breakdown.create';
        $keys = array_keys($construction_list);
        $pdf_show_flags = $this->construction_list->getPdfShowFlag($keys);

        return view('estimate.index')->with([
            'estimate_info' => $estimate_info,
            'keyword' => $keyword,
            'departments' => $this->department->getDepartmentList(),
            'construction_list' => $construction_list,
            'pdf_show_flags' => $pdf_show_flags,
            'breakdown_create_routing' => $breakdown_create_routing,
        ]);
    }

    public function create()
    {
        $departments = $this->department::all();
        $payments = $this->payment::all();
        $construction_name = $this->construction_name->all();
        
        return view('cover.index', compact('construction_name'))->with([
            'construction_count' => $this->estimate_init_count,
            'departments' => $departments,
            'payments' => $payments,
            'estimate_info' => $this->estimate_info,
            'construction_list' => $this->construction_list,
            'registered_construction_list' => array(),
            'action' => route('estimate.store'),
            'prev_url' => route('menu'),
            'regist_type' => config('util.regist_type_create')
        ]);
    }
    /**
     * 登録処理
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(EstimateInfoRequest $request)
    {
        $regist_estimate_info = $this->estimate_info->registEstimateInfo($request);

        if ($regist_estimate_info === true) {
            $message = config('message.regist_complete');
        } else {
            $message = config('message.regist_fail');
        }

        return redirect('estimate/index')->with([
            'message' => $message
        ]);
    }

    /**
     * 更新画面
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        // 登録内容の取得
        $estimate_info = $this->estimate_info::find($id);
        $construction_list = $this->construction_list->getEstimateInfoId($id);

        $departments = $this->department::all();
        $payments = $this->payment::all();
        $construction_name = $this->construction_name->all();

        return view('cover.index')->with([
            'action' => route('estimate.update', ['id' => $id]),
            'construction_name' => $construction_name,
            'construction_count' => $this->estimate_init_count,
            'departments' => $departments,
            'payments' => $payments,
            'estimate_info' => $estimate_info,
            'registered_construction_list' => $construction_list,
            'prev_url' => route('estimate.index'),
            'regist_type' => config('util.regist_type_edit')
        ]);
    }

    /**
     * 更新処理
     * @param EstimateInfo $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(EstimateInfoRequest $request, $id)
    {
        // 更新処理
        $update_estimate_info = $this->estimate_info->update_estimate_info($request, $id);

        if ($update_estimate_info === true) {
            $message = config('message.update_complete');
        } else {
            $message = config('message.update_fail');
        }

        return redirect('estimate/index')->with([
            'message' => $message,
        ]);
    }

    /**
     * 削除処理
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        // 削除処理
        $delete_estimate_info = $this->estimate_info->deleteEstimate($id);

        if ($delete_estimate_info === true) {
            $message = config('message.delete_complete');
        } else {
            $message = config('message.delete_fail');
        }

        return redirect('estimate/index')->with([
            'message' => $message,
        ]);
    }

}
