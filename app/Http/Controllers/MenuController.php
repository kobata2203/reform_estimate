<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MenuController extends Controller
{
    public function menu(Request $request)
    {
        $auth_type = $request->session()->get('auth_type');
        if ($auth_type == config('auth.guards.sales.provider')) {
            $title_name = config('auth.names.saler');
        } elseif ($auth_type == config('auth.guards.admin.provider')) {
            $title_name = config('auth.names.admin');
        }

        return view('menu/index')->with([
            'title_name' => $title_name,
            'auth_type' => $auth_type,
        ]);
    }
}
