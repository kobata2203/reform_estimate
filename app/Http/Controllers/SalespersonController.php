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
    // protected $user;

    // public function __construct(
    //     User $user
    // ) {
    //     $this->user = $user;
    // }

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

    public function add()
    {
        return view('salesperson_add.index');
    }

    public function create(SalespersonRequest $request)
    {
        // Data is already validated at this point
        $validated = $request->validated();

        \Log::info('Validated Data: ', $validated);
        if ($this->user->createUser($validated)) {
            \Log::info('User saved successfully: ', [$validated]);
            return redirect('manager_menu')->with('success', config('message.regist_complete'));
        } else {
            \Log::error('Failed to save user: ', [$validated]);
            return back()->withErrors(config('message.regist_fail'));
        }
    }


    public function edit($id)
    {
        $user = $this->user->fetchUserById($id);
        return view('manager_index.edit', compact('user'));
    }

    public function index(Request $request)
    {
        $keyword = $request->input('search');
        $users = $this->user->searchUsers($keyword);
        return view('manager_index.index', compact('users'));
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
        return redirect()->route('manager_menu.index')->with('success', config('message.update_complete'));
    }


    public function show($id)
    {
        $user = $this->user->findUserWithId($id);
        return view('salesperson.show', compact('user'));
    }

    public function manager_menu()
    {
        return view('manager_menu.index');
    }

    //20241114
    public function itemView($id)
    {
        // Fetch the estimate record or use null if not found
        $estimate_info = $this->estimateInfo->getById($id);

        //calling the construction_name from the ConstructionList
        $construction_list = $this->constructionList->getById($id);
        // Fetch breakdown related to estimate or use an empty collection if no estimate is found
        $breakdown = $estimate_info ? $this->breakdown->getByEstimateId($id) : collect([]);

        // Calculate total amount from breakdown
        $totalAmount = $breakdown->sum('amount') ?? 0;

        // Fetch or create an estimate_calculate record related to this estimate
        $estimate_calculate = $this->estimateCalculate->getOrCreateByEstimateId($id);

        // Set discount to 0 if null, handle calculations even if no data is found
        $discount = $estimate_calculate->special_discount ?? 0;
        $subtotal = $totalAmount - $discount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        // Save or update the estimate_calculate record with the new values
        $estimate_calculate->estimate_id = $id;
        $estimate_calculate->special_discount = $discount;

        try {
            $estimate_calculate->updateCalculations($subtotal, $tax, $grandTotal);
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle any save errors
            session()->flash('error', 'Error saving estimate calculations: ' . $e->getMessage());
        }


        return view('salesperson_menu.show_estimate', compact('breakdown', 'estimate_info', 'id', 'subtotal', 'discount', 'tax', 'grandTotal', 'construction_list'));
    }

    public function showestimate($id)
    {
        $estimate_info = $this->estimateInfo::getEstimateByIde($id);
        $totalAmount = $this->breakdown::getTotalAmountByEstimateId($id);
        $discount = $this->estimateCalculate::getDiscountByEstimateId($id);
        $inputDiscount = request()->input('discount', $discount);
        // Calculate subtotal, tax, and grand total
        $subtotal = $totalAmount - $inputDiscount;
        $tax = $subtotal * 0.1;
        $grandTotal = $subtotal + $tax;

        // Fetch related construction names for this estimate
        $construction_list = $this->constructionList->getConnectionLists([$estimate_info]);
        //forpayment
        $estimate_info = $this->estimateInfo::with('payment')->findOrFail($id);
        // Pass the estimate_info, breakdown, and grandTotal to the view
        return view('salesperson_menu.view_estimate', [
            'estimate_info' => $estimate_info,
            'grandTotal' => $grandTotal,
            'discount' => $inputDiscount,
            'construction_list' => $construction_list[$estimate_info->id] ?? []
        ]);
    }
}
