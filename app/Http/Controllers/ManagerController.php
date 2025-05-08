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
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    protected $manager;
    protected $manager_info;
    protected $estimate_info;
    protected $user;
    protected $breakdown;
    protected $estimate;
    protected $estimate_calculate;
    protected $construction;
    protected $construction_item;
    protected $department;
    protected $payment;
    protected $construction_info;
    protected $construction_name;
    protected $construction_list;
    protected $estimateInitCount = 1;


    public function __construct(
        Manager $manager,
        Managerinfo $manager_info,
        EstimateInfo $estimate_info,
        User $user,
        Breakdown $breakdown,
        Estimate $estimate,
        EstimateCalculate $estimate_calculate,
        ConstructionList $construction_list,
        ConstructionName $construction_name,
        ConstructionItem $construction_item,
        Department $department,
        Payment $payment,
    ) {
        $this->manager = $manager;
        $this->manager_info = $manager_info;
        $this->estimate_info = $estimate_info;
        $this->user = $user;
        $this->breakdown = $breakdown;
        $this->estimate = $estimate;
        $this->estimate_calculate = $estimate_calculate;
        $this->construction_list = $construction_list;
        $this->construction_name = $construction_name;
        $this->construction_item = $construction_item;
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
        $create_admin = $this->user->createAdmin($validated);

        if ($create_admin) {
            return redirect()->route('manager.index')->with([
                'message' => config('message.regist_complete'),
                'success' => true
            ]);
        } else {
            return redirect()->route('manager.index')->with([
                'message' => config('message.regist_fail'),
                'success' => false
            ]);
        }
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
        if(!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }
        $update_admin = $admin->update($validated);

        if ($update_admin) {
            return redirect()->route('manager.index')->with([
                'message' => config('message.update_complete'),
                'success' => true
            ]);
        } else {
            return redirect()->route('manager.index')->with([
                'message' => config('message.update_fail'),
                'success' => false
            ]);
        }

    }

    public function delete($id)
    {
        $admin = $this->user->where('role', User::ROLE_ADMIN)->findOrFail($id);
        $delete_admin = $admin->delete();

        if($delete_admin) {
            $message =  config('message.delete_complete');
        } else {
            $message = config('message.delete_fail');
        }

        return redirect('/manager')->with([
            'message' => $message,
        ]);
    }
}
