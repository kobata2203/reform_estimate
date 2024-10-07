<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Salesperson;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SalespersonController extends Controller
{
    public function add()
    {
        return view('salesperson_add.index');
    }

    public function create(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email', // Ensure email is unique
            'password' => 'required|string|min:6',
        ]);

        // Debugging: Log validated data
        \Log::info('Validated Data: ', $validated);


        $user = new User;
        $user->name = $request->name;
        $user->department_name = $request->department_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->input('password')); // Hash the password for security

        if ($user->save()) {
            // Debugging: Log success message
            \Log::info('User saved successfully: ', [$user]);
            return redirect('manager_menu')->with('success', '営業者が正常に登録されました');
        } else {
            // Debugging: Log failure message
            \Log::error('Failed to save user: ', [$user]);
            return back()->withErrors('User could not be saved.');
        }
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('manager_index.edit', compact('user'));
    }







    public function showForm()
    {
        $departments = [
            (object) ['value' => 'department1', 'label' => '営業１課'],
            (object) ['value' => 'department2', 'label' => '営業１課3系'],
            (object) ['value' => 'department3', 'label' => '営業2課1系'],
            (object) ['value' => 'department4', 'label' => '営業2課2系'],
            (object) ['value' => 'department5', 'label' => '営業3課'],
            (object) ['value' => 'department6', 'label' => '契約管理課']
        ];

        // Make sure to define and pass the $product variable if it's required
        return view('your-view-name', [
            'departments' => $departments,
            // 'product' => $product, // Uncomment if product data is required
        ]);
    }

    // public function index(Request $request)
    // {
    //     $query = Salesperson::query();

    //     if ($request->filled('search')) {
    //         $query->whereHas('department', function ($q) use ($request) {
    //             $q->where('name', 'like', '%' . $request->search . '%');
    //         });
    //     }

    //     $salespersons = $query->with('department')->get();
    //     return view('manager_index.index', compact('salespersons'));
    // }
//     public function index()
// {
//     // Fetch the manager information from the database
//     $manager_info = User::all();  // Or adjust as necessary based on your table structure

    //     // Pass the variable to the view
//     return view('manager_index.index', compact('manager_info'));
// }

public function index(Request $request)
{
    $keyword = $request->input('search');
    $users = User::query();

    if (!empty($keyword)) {
        $users = $users->where('name', 'LIKE', "%{$keyword}%")
            ->orWhere('email', 'LIKE', "%{$keyword}%")
            ->orWhere('department_name', 'LIKE', "%{$keyword}%")
            ->get();
    } else {
        $users = $users->get();
    }

    return view('manager_index.index', compact('users'));
}



    public function list(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->whereHas('department', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $salespersons = $query->with('department')->get();
        return view('salespersons.list', compact('salespersons'));
    }

    // In ManagerController.php
    public function menu()
    {
        return view('manager_menu'); // Assuming you have a 'manager_menu.blade.php' file
    }

    public function update(Request $request, $id)
{
    // Validate the request
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        // Add other fields as necessary
    ]);


    $users = User::findOrFail($id);


    $users->update($validatedData);

    // Redirect or return response
    return redirect()->route('manager_menu.index')->with('success', '更新されました。');
}

public function show($id)
{
    $users = User::findOrFail($id);
    return view('salesperson.show', compact('salesperson')); // Adjust the view as needed
}

public function manager_menu()
    {
        return view('manager_menu/index');
    }



}


