<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Salesperson;
use App\Models\Department;
use Illuminate\Support\Facades\Hash; // Include Hash for password hashing

class SalespersonController extends Controller
{
    public function add()
    {
        return view('salesperson_add');
    }

    public function create(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department_name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $salesperson = new Salesperson;
        $salesperson->id = $request->id; // Ensure this is necessary or handle it in a different way (usually ID is auto-generated)
        $salesperson->name = $request->name;
        $salesperson->department_name = $request->department_name;
        $salesperson->password = Hash::make($request->password);
        $salesperson->save();

        return redirect('/');
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
        $query = Salesperson::query();

        if ($request->filled('search')) {
            $query->whereHas('department', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $salespersons = $query->with('department')->get();
        return view('manager_index.index', compact('salespersons'));

    }

    public function edit($id) {
        $data = SalespersonController::find($id);
        return view('edit', compact('data',"id"));
    }
}
