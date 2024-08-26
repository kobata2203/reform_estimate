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
}


