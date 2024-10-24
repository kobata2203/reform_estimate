<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SalespersonMenuController extends Controller
{
    public function salesperson_menu()
    {
        return view('salesperson_menu/index');
    }
}
