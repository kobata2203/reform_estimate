<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalespersonController extends Controller
{
    public function add()
    {
        return view('/manager_registration');
    }
    
    public function create(Request $request)
    {
        $salesperson = new Salesperson;
        $salesperson->id = $request->id;
        $salesperson->name = $request->name;
        $salesperson->department_name = $request->department_name;
        $salesperson->password = $request->password;
        $salesperson->save();
        return redirect('/manager_registration');
    }
}


