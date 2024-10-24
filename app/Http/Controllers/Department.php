<?php
// namespace App\Http\Controllers;

// use App\Models\Salesperson;
// use App\Models\Department;
// use Illuminate\Http\Request;

// class SalespersonController extends Controller
// {
//     public function index(Request $request)
//     {
//         $query = Salesperson::query();

//         if ($request->filled('search')) {
//             $query->whereHas('department', function ($q) use ($request) {
//                 $q->where('name', 'like', '%' . $request->search . '%');
//             });
//         }

//         $salespersons = $query->with('department')->get();
//         return view('manager_index.index', compact('salespersons'));
//     }

//     public function edit($id)
//     {
//         $salesperson = Salesperson::findOrFail($id);
//         $departments = Department::all(); // Assuming you have a Department model
//         return view('manager_index.edit', compact('salesperson', 'departments'));
//     }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:salespersons,email,' . $id,
//             'password' => 'nullable|string|min:6',
//             'department_name' => 'required|exists:departments,id',
//         ]);

//         $salesperson = Salesperson::findOrFail($id);
//         $salesperson->name = $request->name;
//         $salesperson->email = $request->email;
//         if ($request->filled('password')) {
//             $salesperson->password = bcrypt($request->password);
//         }
//         $salesperson->department_id = $request->department_name;
//         $salesperson->save();

//         return redirect()->route('salespersons.index')->with('success', '営業者情報が更新されました。');
//     }
// }
