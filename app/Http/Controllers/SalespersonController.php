<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Manager;
use App\Models\Estimate;
use App\Models\Breakdown;
use App\Models\Department;
use App\Models\Managerinfo;
use App\Models\EstimateInfo;
use App\Services\PdfService;
use Illuminate\Http\Request;
use App\Models\ConstructionList;
use App\Models\EstimateCalculate;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalespersonRequest;
use App\Http\Requests\UpdateEstimateRequest;

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
    protected $pdfService;

    public function __construct(

        Manager $manager,
        Managerinfo $managerInfo,
        EstimateInfo $estimateInfo,
        User $admin,
        Breakdown $breakdown,
        Estimate $estimate,
        EstimateCalculate $estimateCalculate,
        User $user,
        ConstructionList $constructionList,
        Department $department,
        PdfService $pdfService,
    ) {
        $this->manager = $manager;
        $this->managerInfo = $managerInfo;
        $this->estimateInfo = $estimateInfo;
        $this->admin = $admin->where('role', User::ROLE_ADMIN);
        $this->breakdown = $breakdown;
        $this->estimate = $estimate;
        $this->estimateCalculate = $estimateCalculate;
        $this->user = $user;
        $this->constructionList = $constructionList;
        $this->department = $department;
        $this->pdfService = $pdfService;
    }

    public function create()
    {
        $departments = $this->department::all();
        return view('salesperson.create')->with([
            'action' => route('salesperson.store'),
            'user' => $this->user,
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
        return view('salesperson.create')->with([
            'action' => route('salesperson.update', $user->id),
            'user' => $user,
            'departments' => $departments,
        ]);
    }

    public function update(SalespersonRequest $request, $id)
    {
        $validated = $request->validated();
        $update_user = $this->user->updateUser($id, $validated);

        if ($update_user == true) {
            $message = config('message.update_complete');
        } else {
            $message = config('message.update_fail');
        }

        return redirect()->route('salesperson.index')->with([
            'message' => $message,
        ]);
    }

    public function index(Request $request)
    {
        $keyword = $request->input('search');
        $users = $this->user->where('role', User::ROLE_SALES)
            ->where(function ($query) use ($keyword) {
                if ($keyword) {
                    $query->where('name', 'like', "%$keyword%")
                        ->orWhere('email', 'like', "%$keyword%")
                        ->orWhereHas('department', function ($deptQuery) use ($keyword) {
                            $deptQuery->where('name', 'like', "%$keyword%");
                        });
                }
            })
            ->get();

        return view('salesperson.index')->with([
            'users' => $users,
            'departments' => $this->department->getDepartmentList(),
        ]);
    }


    public function list(Request $request)
    {
        $salespersons = $this->user->searchWithDepartment($request->input('search'));
        return view('salespersons.list', compact('salespersons'));
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

        ));
    }

    public function updateDiscount(UpdateEstimateRequest $request, $id, $construction_id)
    {
        $validated = $request->validated();
        $estimate_info = $this->estimate->getEstimateById($id);

        if (!$estimate_info) {
            $estimate_info = new \stdClass();
        }

        $breakdown = $this->breakdown->breakdownByEstimateIdAndConstructionId($id, $construction_id);
        $totalAmount = $breakdown->sum('amount');
        $estimate_calculate = $this->estimateCalculate->createOrgetEstimateCalculate($id, $construction_id);
        $estimate_calculate->special_discount = $validated['special_discount'];
        $subtotal = $totalAmount - $estimate_calculate->special_discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        $update_estimate = $this->estimateCalculate->estimateCalculateUpdate(
            $estimate_calculate,
            $subtotal,
            $tax,
            $grandTotal
        );

        if ($update_estimate === true) {
            $message = config('message.update_complete');
        } else {
            $message = config('message.update_fail');
        }

        return redirect()->route('salesperson.show', ['id' => $id, 'construction_name' => $construction_id])->with([
            'message' => $message,
        ]);

    }

    public function generateBreakdown($id, $construction_list_id)
    {
        return $this->pdfService->generateBreakdown($id, $construction_list_id);
    }

    public function generateCover($id)
    {
        return $this->pdfService->generateCover($id);
    }

    public function showCover($id)
    {
        $estimate_info = $this->estimateInfo::getEstimateByIde($id);
        $construction_list = $this->constructionList->getByEstimateInfoId($id);

        $totalAmount = 0;
        $totalDiscount = 0;
        $totalSubtotal = 0;
        $totalTax = 0;
        $totalGrandTotal = 0;

        foreach ($construction_list as $construction) {
            $breakdown = $this->breakdown->getBreakdownsByConstructionId($construction->id);
            $amount = $breakdown->sum('amount');
            $discount = $this->estimateCalculate->getDiscountByEstimateIdAndConstructionId($id, $construction->id);
            $subtotal = $amount - $discount;
            $tax = $subtotal * 0.1;
            $grandTotal = $subtotal + $tax;

            $totalAmount += $amount;
            $totalDiscount += $discount;
            $totalSubtotal += $subtotal;
            $totalTax += $tax;
            $totalGrandTotal += $grandTotal;
        }

        return view('estimate.show', [
            'estimate_info' => $estimate_info,
            'totalAmount' => $totalAmount,
            'totalDiscount' => $totalDiscount,
            'totalSubtotal' => $totalSubtotal,
            'totalTax' => $totalTax,
            'totalGrandTotal' => $totalGrandTotal,
            'construction_list' => $construction_list,
            'id' => $id,
        ]);
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
