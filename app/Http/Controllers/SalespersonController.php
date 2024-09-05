<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Salesperson;

class SalespersonController extends Controller
{
    public function add()
    {
        return view('salesperson_add');
    }

    public function create(Request $request)
    {
        //$salesperson = DB::table('salesperson');
        $salesperson = new Salesperson;
        $salesperson->id = $request->id;
        $salesperson->name = $request->name;
        $salesperson->department_name = $request->department_name;
        $salesperson->password = $request->password;
        $salesperson->save();
        return redirect('/');
    }

    public function edit(Request $request, $id)
{
    // Validate the incoming request data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:salespersons,email,' . $id,
        'password' => 'nullable|string|min:6|confirmed',
        'department_name' => 'nullable|string|max:255',
    ]);

    // Find the salesperson by ID
    $salesperson = Salesperson::findOrFail($id);

    // Update salesperson details
    $salesperson->name = $request->name;
    $salesperson->email = $request->email;

    // Only update the password if a new one is provided
    if ($request->filled('password')) {
        $salesperson->password = Hash::make($request->password);
    }

    $salesperson->department_name = $request->department_name;
    $salesperson->save();

    return redirect('/')->with('status', 'Salesperson updated successfully!');
}


public function showForm()
{
    $departments = [
        (object) ['value' => 'department1', 'label' => '営業１課'],
        (object) ['value' => 'department2', 'label' => '営業１課3系'],
        (object) ['value' => 'department3', 'label' => '営業2課1系'],
        (object) ['value' => 'department4', 'label' => '営業2課2系'],
        (object) ['value' => 'department4', 'label' => '営業3課'],
        (object) ['value' => 'department4', 'label' => '契約管理課']
    ];

    return view('your-view-name', [
        'departments' => $departments,
        'product' => $product, // Make sure to pass the product data
    ]);
}

}


