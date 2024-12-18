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
    }

    public function create()
    {
        return view('salesperson.create');
    }

    public function store(SalespersonRequest $request)
    {
        $validated = $request->validated();

        \Log::info('Validated Data: ', $validated);
        if ($this->user->createUser($validated)) {
            \Log::info('User saved successfully: ', [$validated]);
            return redirect('/salesperson')->with('success', config('message.regist_complete'));
        } else {
            \Log::error('Failed to save user: ', [$validated]);
            return back()->withErrors(config('message.regist_fail'));
        }
    }

    public function edit($id)
    {
        $user = $this->user->fetchUserById($id);
        return view('salesperson.edit', compact('user'));
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

        if($delete_user === true) {
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

    //20241114
    public function itemView($id)
    {
        //estimate record
        $estimate_info = $this->estimateInfo->getById($id);

        //ConstructionListからconstruction_nameを呼び出す
        $construction_list = $this->constructionList->getById($id);
        //見積に関連する内訳を取得する
        $breakdown = $estimate_info ? $this->breakdown->getByEstimateId($id) : collect([]);

        //内訳から合計金額を計算
        $totalAmount = $breakdown->sum('amount') ?? 0;

        //この見積に関連する estimate_calculate レコードを取得
        $estimate_calculate = $this->estimateCalculate->getOrCreateByEstimateId($id);

        $discount = $estimate_calculate->special_discount ?? 0;
        $subtotal = $totalAmount - $discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;
        $estimate_calculate->estimate_id = $id;
        $estimate_calculate->special_discount = $discount;

        try {
            $estimate_calculate->updateCalculations($subtotal, $tax, $grandTotal);
        } catch (\Illuminate\Database\QueryException $e) {
            session()->flash('error', 'Error saving estimate calculations: ' . $e->getMessage());
        }


        return view('estimate.salesperson.show_estimate', compact('breakdown', 'estimate_info', 'id', 'subtotal', 'discount', 'tax', 'grandTotal', 'construction_list'));
    }

    public function showestimate($id)
    {
        $estimate_info = $this->estimateInfo::getEstimateByIde($id);
        $totalAmount = $this->breakdown::getTotalAmountByEstimateId($id);
        $discount = $this->estimateCalculate::getDiscountByEstimateId($id);
        $inputDiscount = request()->input('discount', $discount);
        // 小計、税額、合計金額を計算
        $subtotal = $totalAmount - $inputDiscount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        //見積もりに関連する工事名を取得
        $construction_list = $this->constructionList->getConnectionLists([$estimate_info]);
        //お支払い方法
        $estimate_info = $this->estimateInfo::with('payment')->findOrFail($id);
        return view('estimate.salesperson.view_estimate', [
            'estimate_info' => $estimate_info,
            'grandTotal' => $grandTotal,
            'discount' => $inputDiscount,
            'construction_list' => $construction_list[$estimate_info->id] ?? []
        ]);
    }
}
