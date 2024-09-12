<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Managerinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $manager_info = Manager::where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('department_name', 'like', "%{$search}%")
            ->get();

        return view('manager_index.index', compact('manager_info', 'search'));
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
