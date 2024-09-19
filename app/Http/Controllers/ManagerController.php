<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Managerinfo;
use App\Models\EstimateInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
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

        return view('manager_menu.estimate_index', compact('estimate_info', 'keyword'));
    }

    public function create()
    {
        return view('manager_index.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:managers',
            'password' => 'required|string|min:6',
            'department_name' => 'required|string|max:255',
        ]);

        Manager::create([  // Update this line
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_name' => $request->department_name,
        ]);

        return redirect()->route('managers.index');
    }

    public function edit($id)
    {
        $manager = Manager::findOrFail($id);  // Update this line
        return view('manager_index.edit', ['manager' => $manager]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6',
            'department_name' => 'required|string|max:255',
        ]);

        $manager = Manager::findOrFail($id);  // Update this line
        $manager->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $manager->password,
            'department_name' => $request->department_name,
        ]);

        return redirect()->route('managers.index');
    }

    public function destroy($id)
    {
       //
    }

    public function show($id)
    {
        $manager = Managerinfo::findOrFail($id);  // Fetch a specific manager
        return view('manager_estimate_index.show', compact('manager'));
    }

}
