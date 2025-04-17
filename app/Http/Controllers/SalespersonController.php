<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Manager;
use App\Models\Estimate;
use App\Models\Breakdown;
use App\Models\Department;
use App\Models\ManagerInfo;
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
    protected $manager_info;
    protected $estimate_info;
    protected $admin;
    protected $breakdown;
    protected $estimate;
    protected $estimate_calculate;
    protected $user;
    protected $construction_list;
    protected $pdf_service;
    protected $department;

    public function __construct(
        Manager $manager,
        ManagerInfo $manager_info,
        EstimateInfo $estimate_info,
        User $admin,
        Breakdown $breakdown,
        Estimate $estimate,
        EstimateCalculate $estimate_calculate,
        User $user,
        ConstructionList $construction_list,
        Department $department,
        PdfService $pdf_service
    ) {
        $this->manager = $manager;
        $this->manager_info = $manager_info;
        $this->estimate_info = $estimate_info;
        $this->admin = $admin->where('role', User::ROLE_ADMIN);
        $this->breakdown = $breakdown;
        $this->estimate = $estimate;
        $this->estimate_calculate = $estimate_calculate;
        $this->user = $user;
        $this->construction_list = $construction_list;
        $this->department = $department;
        $this->pdf_service = $pdf_service;
    }

    public function create()
    {
        $departments = $this->department->getAllDepartments();
        return view('salesperson.create', [
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
        $departments = $this->department->getAllDepartments();

        return view('salesperson.create', [
            'action' => route('salesperson.update', $user->id),
            'user' => $user,
            'departments' => $departments,
        ]);
    }

    public function update(SalespersonRequest $request, $id)
    {
        $validated = $request->validated();
        $update_user = $this->user->updateUser($id, $validated);

        $message = $update_user ? config('message.update_complete') : config('message.update_fail');

        return redirect()->route('salesperson.index')->with([
            'message' => $message,
        ]);
    }

    public function index(Request $request)
    {
        $keyword = $request->input('search');
        $users = $this->user->searchUsers($keyword, User::ROLE_SALES);

        return view('salesperson.index', [
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
        $delete_user = $this->user->deleteUser($id);

        $message = $delete_user ? config('message.delete_complete') : config('message.delete_fail');

        return redirect('/salesperson')->with([
            'message' => $message,
        ]);
    }

    public function show($id)
    {
        $user = $this->user->getUserById($id);
        return view('salesperson.show', compact('user'));
    }

    public function itemView(Request $request, $id)
    {
        $estimate_info = $this->estimate_info->getEstId($id);
        $construction_list = $this->construction_list->getByEstimateInfoId($id);
        $construction_names = $this->construction_list->getConstructionName($id);
        $selected_construction_id = $request->input('construction_name', $construction_names->first()->id ?? null);

        $breakdown = $selected_construction_id
            ? $this->breakdown->byConstructionAndEstimate($selected_construction_id, $id)->get()
            : collect([]);

        $calculations = $this->estimate_calculate->calculateAndUpdate($id, $selected_construction_id, $breakdown);

        return view('estimate.show_estimate', array_merge([
            'breakdown' => $breakdown,
            'estimate_info' => $estimate_info,
            'id' => $id,
            'construction_list' => $construction_list,
            'constructionNames' => $construction_names,
            'selectedConstructionId' => $selected_construction_id,
        ], $calculations));
    }

    public function updateDiscount(UpdateEstimateRequest $request, $id, $constructionId)
    {
        $validated = $request->validated();
        $estimate_info = $this->estimate->getEstimateById($id);

        if (!$estimate_info) {
            $estimate_info = new \stdClass();
        }

        $breakdown = $this->breakdown->breakdownByEstimateIdAndConstructionId($id, $constructionId);
        $total_amount = $breakdown->sum('amount');
        $estimate_calculate = $this->estimate_calculate->createOrGetEstimateCalculate($id, $constructionId);
        $estimate_calculate->updateSpecialDiscount($validated['special_discount']);
        $subtotal = $total_amount - $estimate_calculate->special_discount;
        $tax = $subtotal * 0.1;
        $grand_total = $subtotal + $tax;

        $update_estimate = $this->estimate_calculate->estimateCalculateUpdate(
            $estimate_calculate,
            $subtotal,
            $tax,
            $grand_total
        );

        $message = $update_estimate ? config('message.update_complete') : config('message.update_fail');

        return redirect()->route('salesperson.show', ['id' => $id, 'construction_name' => $constructionId])->with([
            'message' => $message,
        ]);
    }

    public function generateBreakdown($id, $constructionListId)
    {
        return $this->pdf_service->generateBreakdown($id, $constructionListId);
    }

    public function generateCover($id)
    {
        return $this->pdf_service->generateCover($id);
    }

    public function showCover($id)
    {
        $estimate_info = $this->estimate_info->getEstId($id);
        $construction_list = $this->construction_list->getByEstimateInfoId($id);

        $totals = collect($construction_list)->map(function ($construction) use ($id) {
            $breakdown = $this->breakdown->getBreakdownsByConstructionId($construction->id);
            $amount = $breakdown->sum('amount');
            $discount = $this->estimate_calculate->getDiscountByEstimateIdAndConstructionId($id, $construction->id) ?? 0;
            $subtotal = $amount - $discount;
            $tax = $subtotal * 0.1;
            $grandTotal = $subtotal + $tax;

            return compact('amount', 'discount', 'subtotal', 'tax', 'grandTotal');
        });

        return view('estimate.show', [
            'estimate_info' => $estimate_info,
            'totalAmount' => $totals->sum('amount'),
            'totalDiscount' => $totals->sum('discount'),
            'totalSubtotal' => $totals->sum('subtotal'),
            'totalTax' => $totals->sum('tax'),
            'totalGrandTotal' => $totals->sum('grandTotal'),
            'construction_list' => $construction_list,
            'id' => $id,
        ]);
    }

}
