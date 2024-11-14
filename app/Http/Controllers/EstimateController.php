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

class EstimateController extends Controller
{
    protected $estimate;
    protected $construction;
    protected $constructionItem;
    protected $breakdown;
    protected $department;
    protected $payment;
    protected $constructionInfo;
    protected $constructionName;
    protected $constructionList;

    protected $estimateInitCount = 1; // 工事名の初期表示数
    /**
     * 初期処理
     * 使用するクラスのインスタンス化
     */
    public function __construct(
        EstimateInfo $constructionInfo,
        ConstructionList $constructionList,
        ConstructionName $constructionName,
        ConstructionItem $constructionItem,
        Breakdown $breakdown,
        Department $department,
        Payment $payment,
    )
    {
        $this->estimateInfo = $constructionInfo;
        $this->constructionList = $constructionList;
        $this->constructionName = $constructionName;
        $this->constructionItem = $constructionItem;
        $this->breakdown = $breakdown;
        $this->department = $department;
        $this->payment = $payment;
    }
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
        $departments = $this->department::all();
        $payments = $this->payment::all();
        $construction_name = $this->constructionName->get_target_construction_name();

        return view('cover.index',compact('construction_name'))->with([
            'construction_count' => $this->estimateInitCount,
            'departments' => $departments,
            'payments' => $payments,
            'estimate_info' => $this->estimateInfo,
            'construction_list' => $this->constructionList,
            'registered_construction_list' => array(),
            'action' => route('estimate.store'),
        ]);
    }
    /**
     * 登録処理
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(EstimateInfoRequest $request)
    {
        $regist_estimate_info = $this->estimateInfo->regist_estimate_info($request);

        if($regist_estimate_info === true) {
            $message = config('message.regist_complete');
        } else {
            $message = config('message.regist_fail');
        }

        return redirect('estimate/index')->with('message', $message);
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
        $construction_list = $this->constructionList->find_estimate_info_id($id);

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

        if($update_estimate_info === true) {
            $message = config('message.update_complete');
        } else {
            $message = config('message.update_fail');
        }

        return redirect('estimate/index')->with([
            'message' => $message,
        ]);
    }

    public function breakdown_create($id)
    {
        $estimate_info = $this->estimateInfo::find($id);
        $construction_name = $this->constructionName::find($id);
        $prevurl = url()->previous()?: 'estimate/index'; // 直前のページURLを取得、取得できない場合はデフォルト値を設定

        /**
         * SQLはモデルに記載する
         */
        $construction_items = $this->constructionItem->get_target_items($estimate_info->construction_id);
        $breakdown_items = $this->breakdown->get_breakdown_list($id);

        if(count($breakdown_items) == 0) {
            $regist_flag = true;
        } else {
            $regist_flag = false;
        }

        return view('breakdown.breakdown_create')->with([
            'id' => $id,
            'estimate_info' => $estimate_info,
            'construction_name' => $construction_name,
            'construction_loop_count' => $construction_name->loop_count,
            'construction_items' => $construction_items,
            'breakdown_items' => $breakdown_items,
            'prevurl' => $prevurl,
            'regist_flag' => $regist_flag,
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

        if(!empty($request->regist_flag)) {
            $regist_breakdown = $this->breakdown->regist_breakdown($request);

            if($regist_breakdown === true) {
                $message = config('message.regist_complete');
            } else {
                $message = config('message.regist_fail');
            }
        } else {
            $regist_breakdown = $this->breakdown->update_breakdown($request);

            if($regist_breakdown === true) {
                $message = config('message.update_complete');
            } else {
                $message = config('message.update_fail');
            }
        }

        return redirect('estimate')->with([
            'message' => $message,
            'prevurl' => $prevurl,
        ]);
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
