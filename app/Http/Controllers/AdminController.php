<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $manager_info = Admin::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })->get();

        return view('admins.index', compact('manager_info'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        Admin::create($validated);

        return redirect()->route('admins.index');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id); // Retrieve the admin by ID or fail if not found
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id); // Retrieve the admin by ID or fail if not found

        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id, // Ensure the email is unique except for the current admin
            'password' => 'nullable|string|min:8', // Password can be null if not changing
        ]);

        // Update the admin's data
        $admin->name = $validated['name'];
        $admin->department_name = $validated['department_name'];
        $admin->email = $validated['email'];

        // Update password only if it was provided
        if (!empty($validated['password'])) {
            $admin->password = bcrypt($validated['password']);
        }

        $admin->save(); // Save the changes

        // Redirect back to the index page with a success message
        return redirect()->route('admins.index')->with('success', '管理者情報が更新されました。');
    }

    public function destroy($id)
    {
        Admin::destroy($id);
        return redirect()->route('admins.index');
    }
}
