<?php

namespace App\Http\Controllers\Auth\Sales;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthSaleController extends Controller
{
    protected $role;

    public function __construct()
    {
        $this->role = User::ROLE_SALES;
        $this->middleware('guest:sales')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.sales.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password', 'role');
        $credentials['role'] = $this->role;

        if (Auth::guard('sales')->attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put('auth_type', config('auth.guards.sales.provider'));
            return redirect()->intended('/menu');
        }

        return back()->withErrors([
            'email' => config('message.login_fail'),
        ]);
    }
}
