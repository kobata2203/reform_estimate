<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Manager;
use App\Models\Estimate;
use App\Models\Breakdown;
use App\Models\Managerinfo;
use App\Models\EstimateInfo;
use Illuminate\Http\Request;
use App\Models\EstimateCalculate;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalespersonRequest;
use App\Models\ConstructionList;
use App\Models\Department;

class SalespersonController extends Controller
{
    protected $manager;
    protected $managerInfo;
    protected $estimateInfo;
    protected $admin;
    protected $breakdown;
    protected $estimate;
    protected $estimateCalculate;
    protected $user;
    protected $constructionList;

    public function __construct(

        Manager $manager,
        Managerinfo $managerInfo,
        EstimateInfo $estimateInfo,
        Admin $admin,
        Breakdown $breakdown,
        Estimate $estimate,
        EstimateCalculate $estimateCalculate,
        User $user,
        ConstructionList $constructionList,
        Department $department,
    ) {
        $this->manager = $manager;
        $this->managerInfo = $managerInfo;
        $this->estimateInfo = $estimateInfo;
        $this->admin = $admin;
        $this->breakdown = $breakdown;
        $this->estimate = $estimate;
        $this->estimateCalculate = $estimateCalculate;
        $this->user = $user;
        $this->constructionList = $constructionList;
        $this->department = $department;
    }

    public function create()
    {
        $departments = $this->department::all();
        return view('salesperson.create')->with([
            'departments' => $departments,
        ]);
    }

    public function store(SalespersonRequest $request)
    {
        $create_user = $this->user->createUser($request);

        if ($create_user == true) {
            $message = config('message.regist_complete');
        } else {
            $message = config('message.regist_fail');
        }

        return redirect()->route('salesperson.index')->with([
            'message' => $message,
        ]);
    }

    public function edit($id)
    {
        $user = $this->user->fetchUserById($id);
        $departments = $this->department::all();
        return view('salesperson.edit', compact('user'))->with([
            'departments' => $departments,
        ]);
    }

    public function index(Request $request)
    {
        $keyword = $request->input('search');
        $users = $this->user->searchUsers($keyword);
        return view('salesperson.index', compact('users'));
    }

    public function list(Request $request)
    {
        $salespersons = $this->user->searchWithDepartment($request->input('search'));
        return view('salespersons.list', compact('salespersons'));
    }

    public function update(SalespersonRequest $request, $id)
    {
        $validated = $request->validated();
        $this->user->updateUser($id, $validated);
        return redirect()->route('salesperson.index')->with('success', config('message.update_complete'));
    }

    public function delete($id)
    {
        // 削除処理
        $delete_user = $this->user->deleteUser($id);

        if ($delete_user == true) {
            $message = config('message.delete_complete');
        } else {
            $message = config('message.delete_fail');
        }

        return redirect('/salesperson')->with([
            'message' => $message,
        ]);
    }

    public function show($id)
    {
        $user = $this->user->findUserWithId($id);
        return view('salesperson.show', compact('user'));
    }

    public function itemView(Request $request, $id)
    {
        $referrer = session('referrer', 'manager'); // 各内訳明細よりもどるため
        $prevurl = $referrer == 'salesperson'
            ? route('estimate.index')
            : route('manager_estimate.index');
        $estimate_info = $this->estimateInfo->getById($id);
        $construction_list = $this->constructionList->getByEstimateInfoId($id);
        $selectedConstructionId = $request->input('construction_name', $construction_list->first()->id ?? null);

        $breakdown = $selectedConstructionId
            ? $this->breakdown
                ->byConstructionAndEstimate($selectedConstructionId, $id)
                ->get()
            : collect([]);

        $totalAmount = $breakdown->sum('amount') ?? 0;
        $estimate_calculate = $this->estimateCalculate->getOrCreateByEstimateAndConstructionId($id, $selectedConstructionId);

        $discount = $estimate_calculate->special_discount ?? 0;

        $subtotal = $totalAmount - $discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        try {
            $estimate_calculate->updateCalculations($subtotal, $tax, $grandTotal);
        } catch (\Illuminate\Database\QueryException $e) {
            session()->flash('error', 'Error saving estimate calculations: ' . $e->getMessage());
        }

        $constructionNames = $this->constructionList
            ->select('construction_list.*')
            ->leftJoin('breakdown', 'construction_list.id', '=', 'breakdown.construction_list_id')
            ->where('construction_list.estimate_info_id', $id)
            ->whereNotNull('breakdown.id')
            ->groupBy('construction_list.id')
            ->get();

        return view('estimate.show_estimate', compact(
            'breakdown',
            'estimate_info',
            'id',
            'subtotal',
            'discount',
            'tax',
            'grandTotal',
            'construction_list',
            'constructionNames',
            'selectedConstructionId',
            'prevurl'

        ));
    }

    // public function showestimate($id)
    // {
    //     $estimate_info = $this->estimateInfo::getEstimateByIde($id);
    //     $totalAmount = $this->breakdown::getTotalAmountByEstimateId($id);
    //     $discount = $this->estimateCalculate::getDiscountByEstimateId($id);
    //     $inputDiscount = request()->input('discount', $discount);
    //     // 小計、税額、合計金額を計算
    //     $subtotal = $totalAmount - $inputDiscount;
    //     $tax = $subtotal * 0.1;
    //     $grandTotal = $subtotal + $tax;

    //     //見積もりに関連する工事名を取得
    //     $construction_list = $this->constructionList->getConnectionLists([$estimate_info]);
    //     //お支払い方法
    //     $estimate_info = $this->estimateInfo::with('payment')->findOrFail($id);
    //     return view('estimate.salesperson.view_estimate', [
    //         'estimate_info' => $estimate_info,
    //         'grandTotal' => $grandTotal,
    //         'discount' => $inputDiscount,
    //         'construction_list' => $construction_list[$estimate_info->id] ?? []
    //     ]);
    // }
}
