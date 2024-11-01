<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SalespersonController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = new User();

    }


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

        // Use the User model to create a new user
        $user = new $this->user;

        if ($user->createUser($validated)) {
            // Debugging: Log success message
            \Log::info('User saved successfully: ', [$validated]);
            return redirect('manager_menu')->with('success', '営業者が正常に登録されました');
        } else {
            // Debugging: Log failure message
            \Log::error('Failed to save user: ', [$validated]);
            return back()->withErrors('User could not be saved.');
        }
    }

    public function edit($id)
    {
        $user = $this->user->fetchUserById($id);
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


    public function index(Request $request)
    {
        $keyword = $request->input('search');
        $users = User::searchUsers($keyword); // Call the search method from the User model

        return view('manager_index.index', compact('users'));
    }

  // In your Controller
public function list(Request $request)
{
    $salespersons = $this->user::searchWithDepartment($request->input('search'))->get();
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

    ]);

    $this->user->updateUser($id, $validatedData);

    // Redirect or return response
    return redirect()->route('manager_menu.index')->with('success', '更新されました。');
}


public function show($id)
{
    // Use the model method to find the user
    $user = $this->user->findUserWithId($id);

    return view('salesperson.show', compact('user')); // Adjust the view as needed
}


public function manager_menu()
    {
        return view('manager_menu/index');
    }



}


