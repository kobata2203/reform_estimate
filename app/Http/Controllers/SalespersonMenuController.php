<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalespersonMenuController extends Controller
{
    public function salesperson_menu()
    {
        return view('salesperson_menu/index');
    }
}
