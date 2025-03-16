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
        $messages = [
            'email.required' => config('message.email_required'),
            'email.email' => config('message.email_invalid'),
            'password.required' => config('message.password_required'),
        ];

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);

        $credentials['role'] = $this->role;

        if (Auth::guard('sales')->attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put('auth_type', 'sales');
            return redirect()->intended('/menu');
        }

        return back()->withErrors([
            'login' => config('message.credentials_invalid'),
            'email' => config('message.email_invalid'),
            'password' => config('message.password_invalid'),
        ]);
    }
}
