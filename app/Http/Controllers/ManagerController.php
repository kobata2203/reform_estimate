<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Manager;
use App\Models\Payment;
use App\Models\Estimate;
use App\Models\Breakdown;
use App\Models\Department;
use App\Models\Managerinfo;
use App\Models\EstimateInfo;
use App\Services\PdfService;
use Illuminate\Http\Request;
use App\Models\ConstructionItem;
use App\Models\ConstructionList;
use App\Models\ConstructionName;
use App\Models\EstimateCalculate;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdateEstimateRequest;

class ManagerController extends Controller
{
    protected $manager;
    protected $managerInfo;
    protected $estimateInfo;
    protected $admin;
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
    protected $estimateInitCount = 1; // 工事名の初期表示数
   

    public function __construct(

        Manager $manager,
        Managerinfo $managerInfo,
        EstimateInfo $estimateInfo,
        Admin $admin,
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
        $this->admin = $admin;
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
        $manager_info = $this->admin->searchAdmin($keyword);
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
            'admin' => $this->admin,
            'departments' => $departments,
        ]);
    }

    public function store(CreateAdminRequest $request)
    {
        $create_admin = $this->admin->createAdmin($request);

        if ($create_admin == true) {
            $message = config('message.regist_complete');
        } else {
            $message = config('message.regist_fail');
        }

        return redirect()->route('manager.index')->with([
            'message' => $message,
        ]);
    }

    public function edit($id)
    {
        $admin = $this->admin->findAdminById($id);
        $departments = $this->department::all();
        return view('manager.create')->with([
            'action' => route('manager.update', $admin->id),
            'admin' => $admin,
            'departments' => $departments,
        ]);
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        $validated = $request->validated();

        $update_admin = $this->admin->updateAdmin($id, $validated);

        if ($update_admin == true) {
            $message = config('message.update_complete');
        } else {
            $message = config('message.update_fail');
        }

        return redirect()->route('manager.index')->with([
            'message' => $message,
        ]);
    }

    public function delete($id)
    {
        // 削除処理
        $delete_admin = $this->admin->deleteAdmin($id);

        if ($delete_admin == true) {
            $message = config('message.delete_complete');
        } else {
            $message = config('message.delete_fail');
        }

        return redirect('/manager')->with([
            'message' => $message,
        ]);
    }
}


