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
    protected $constructionItem;
    protected $breakdown;
    protected $department;
    protected $payment;
    protected $constructionName;
    protected $constructionList;
    protected $estimateInfo;

    protected $estimateInitCount = 1; // 工事名の初期表示数
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
    ) {
        $this->estimateInfo = $estimateInfo;
        $this->constructionList = $constructionList;
        $this->constructionName = $constructionName;
        $this->constructionItem = $constructionItem;
        $this->breakdown = $breakdown;
        $this->department = $department;
        $this->payment = $payment;
        $this->estimateInfo = $estimateInfo;
    }


    public function index(Request $request)
    {
        session(['referrer' => 'salesperson']);
        $keyword = $request->input('keyword');
        $estimate_info = $this->estimateInfo->getEstimateInfo($keyword);
        $construction_list = $this->constructionList->getConnectionLists($estimate_info);
        $prevurl = url('salesperson_menu'); // 直前のページURLを取得、取得できない場合はデフォルト値を設定
        $breakdown_create_routing = 'breakdown.create';
        $keys = array_keys($construction_list);
        $pdf_show_flags = $this->constructionList->getPdfShowFlag($keys);

        return view('estimate.estimate_index')->with([
            'estimate_info' => $estimate_info,
            'keyword' => $keyword,
            'departments' => $this->department->getDepartmentList(),
            'construction_list' => $construction_list,
            'pdf_show_flags' => $pdf_show_flags,
            'prevurl' => $prevurl,
            'breakdown_create_routing' => $breakdown_create_routing,
        ]);
    }

    public function create()
    {
        $departments = $this->department::all();
        $payments = $this->payment::all();
        $construction_name = $this->constructionName->get_target_construction_name();
        $prevurl = url('estimate.index'); // 直前のページURLを取得、取得できない場合はデフォルト値を設定

        return view('cover.index', compact('construction_name'))->with([
            'construction_count' => $this->estimateInitCount,
            'departments' => $departments,
            'payments' => $payments,
            'estimate_info' => $this->estimateInfo,
            'construction_list' => $this->constructionList,
            'registered_construction_list' => array(),
            'action' => route('estimate.store'),
            'prevurl' => $prevurl,
        ]);
    }
    /**
     * 登録処理
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(EstimateInfoRequest $request)
    {
        $prevurl = url('estimate.index');	//一覧画面のURLを直接指定

        $regist_estimate_info = $this->estimateInfo->registEstimateInfo($request);

        if ($regist_estimate_info === true) {
            $message = config('message.regist_complete');
        } else {
            $message = config('message.regist_fail');
        }

        return redirect('estimate/index')->with([
            'message' => $message,
            'prevurl' => $prevurl,
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
        $estimate_info = $this->estimateInfo::find($id);
        $construction_list = $this->constructionList->getEstimateInfoId($id);

        $departments = $this->department::all();
        $payments = $this->payment::all();
        $construction_name = $this->constructionName->get_target_construction_name();


      
            
        return view('cover.index')->with([
            'action' => route('estimate.update', ['id'=>$id]),
            'construction_name' => $construction_name,
            'construction_count' => $this->estimateInitCount,
            'departments' => $departments,
            'payments' => $payments,
            'estimate_info' => $estimate_info,
            'registered_construction_list' => $construction_list,
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
        $update_estimate_info = $this->estimateInfo->update_estimate_info($request, $id);

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
        $delete_estimate_info = $this->estimateInfo->deleteEstimate($id);

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

