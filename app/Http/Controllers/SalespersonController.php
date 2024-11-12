<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalespersonRequest;


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

    public function create(SalespersonRequest $request)
    {
        // Data is already validated at this point
        $validated = $request->validated();

        \Log::info('Validated Data: ', $validated);
        if ($this->user->createUser($validated)) {
            \Log::info('User saved successfully: ', [$validated]);
            return redirect('manager_menu')->with('success', '営業者が正常に登録されました');
        } else {
            \Log::error('Failed to save user: ', [$validated]);
            return back()->withErrors('User could not be saved.');
        }
    }


    public function edit($id)
    {
        $user = $this->user->fetchUserById($id);
        return view('manager_index.edit', compact('user'));
    }

    public function index(Request $request)
    {
        $keyword = $request->input('search');
        $users = $this->user->searchUsers($keyword);
        return view('manager_index.index', compact('users'));
    }

    public function list(Request $request)
    {
        $salespersons = $this->user->searchWithDepartment($request->input('search'));
        return view('salespersons.list', compact('salespersons'));
    }




    public function update(SalespersonRequest $request, $id)
{

    $validated  = $request->validated();

    $this->user->updateUser($id, $validated );

    return redirect()->route('manager_menu.index')->with('success', '更新されました。');
}


    public function show($id)
    {
        $user = $this->user->findUserWithId($id);
        return view('salesperson.show', compact('user'));
    }

    public function manager_menu()
    {
        return view('manager_menu.index');
    }
}
