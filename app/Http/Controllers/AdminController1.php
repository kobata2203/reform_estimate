<?php

namespace App\Http\Controllers;

use App\Models\Admin1;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController1 extends Controller
{
    // Display a listing of the admins
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $admins = Admin1::when($keyword, function ($query, $keyword) {
            return $query->where('name', 'like', "%{$keyword}%")
                         ->orWhere('department_name', 'like', "%{$keyword}%")
                         ->orWhere('email', 'like', "%{$keyword}%");
        })->get();

        return view('manager_estimate_index.estimate_index', compact('admins', 'keyword'));
    }

    // Show the form for creating a new admin
    public function create()
    {
        return view('manager_estimate_index.estimate_create');
    }

    // Store a newly created admin in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'construction_name' => 'required|string|max:255',
            'charger_name' => 'required|string|max:255',
            'department_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
        ]);

        $validated['password'] = bcrypt($validated['password']); // Hash the password before saving

        Admin1::create($validated);

        return redirect()->route('estimate.index')->with('success', 'Admin created successfully.');
    }

    // Display the specified admin
    public function show($id)
{
    $admin = Admin1::findOrFail($id);

    // Check if the request is for downloading the PDF
    if (request()->has('download')) {
        $pdf = Pdf::loadView('manager_estimate_index.estimate_show', compact('admin'));
        return $pdf->download('estimate.pdf'); // This will trigger the download
    }

    // Default behavior is to return the view
    return view('manager_estimate_index.estimate_show', compact('admin'));
}


}
