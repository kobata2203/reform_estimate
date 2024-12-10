<?php

namespace App\Http\Controllers;
use App\Models\Admin;

use Illuminate\Http\Request;

class ManagerMenuController extends Controller
{
    public function index()
    {
        return view('manager_menu/index');
    }

}

