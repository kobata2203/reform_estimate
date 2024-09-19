<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerMenuController extends Controller
{
    public function manager_menu()
    {
        return view('manager_menu/index');
    }
}
