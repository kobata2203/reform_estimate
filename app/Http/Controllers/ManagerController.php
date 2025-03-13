<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Manager;
use App\Models\Payment;
use App\Models\Estimate;
use App\Models\Breakdown;
use App\Models\Department;
use App\Models\Managerinfo;
use App\Models\EstimateInfo;
use Illuminate\Http\Request;
use App\Models\ConstructionItem;
use App\Models\ConstructionList;
use App\Models\ConstructionName;
use App\Models\EstimateCalculate;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

class ManagerController extends Controller
{
    protected $manager;
    protected $managerInfo;
    protected $estimateInfo;
    protected $user;
    protected $breakdown;
    protected $estimate;
    protected $estimateCalculate;
    protected $construction;
    protected $constructionItem;
    protected $department;
    protected $payment;
    protected $constructionInfo;
    protected $constructionName;
    protected $constructionList;
    protected $estimateInitCount = 1;


    public function __construct(
        Manager $manager,
        Managerinfo $managerInfo,
        EstimateInfo $estimateInfo,
        User $user,
        Breakdown $breakdown,
        Estimate $estimate,
        EstimateCalculate $estimateCalculate,
        ConstructionList $constructionList,
        ConstructionName $constructionName,
        ConstructionItem $constructionItem,
        Department $department,
        Payment $payment,
    ) {
        $this->manager = $manager;
        $this->managerInfo = $managerInfo;
        $this->estimateInfo = $estimateInfo;
        $this->user = $user;
        $this->breakdown = $breakdown;
        $this->estimate = $estimate;
        $this->estimateCalculate = $estimateCalculate;
        $this->constructionList = $constructionList;
        $this->constructionName = $constructionName;
        $this->constructionItem = $constructionItem;
        $this->department = $department;
        $this->payment = $payment;

    }

    public function index(Request $request)
    {
        $keyword = $request->input('search');
        $manager_info = $this->user->where('role', User::ROLE_ADMIN)
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

        return view('manager.index')->with([
            'manager_info' => $manager_info,
            'departments' => $this->department->getDepartmentList(),
        ]);
    }

    public function create()
    {
        $departments = $this->department::all();
        return view('manager.create')->with([
            'action' => route('manager.store'),
            'user' => new User(),
            'departments' => $departments,
        ]);
    }

    public function store(CreateAdminRequest $request)
    {
        $validated = $request->validated();
        $validated['role'] = User::ROLE_ADMIN;
        $create_admin = $this->user->create($validated);
        $message = $create_admin ? config('message.regist_complete') : config('message.regist_fail');

        return redirect()->route('manager.index')->with([
            'message' => $message,
        ]);
    }

    public function edit($id)
    {
        $admin = $this->user->where('role', User::ROLE_ADMIN)->findOrFail($id);
        $departments = $this->department::all();

        return view('manager.create')->with([
            'action' => route('manager.update', $admin->id),
            'user' => $admin,
            'departments' => $departments,
        ]);
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        $validated = $request->validated();
        $admin = $this->user->where('role', User::ROLE_ADMIN)->findOrFail($id);
        $update_admin = $admin->update($validated);
        $message = $update_admin ? config('message.update_complete') : config('message.update_fail');

        return redirect()->route('manager.index')->with([
            'message' => $message,
        ]);
    }

    public function delete($id)
    {
        $admin = $this->user->where('role', User::ROLE_ADMIN)->findOrFail($id);
        $delete_admin = $admin->delete();
        $message = $delete_admin ? config('message.delete_complete') : config('message.delete_fail');

        return redirect('/manager')->with([
            'message' => $message,
        ]);
    }
}
