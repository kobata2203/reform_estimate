<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class AuthAdminController extends Controller
{
    protected $role;

    public function __construct()
    {
        $this->role = User::ROLE_ADMIN;
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password', 'role');
        $credentials['role'] = $this->role;

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put('auth_type', config('auth.guards.admin.provider'));
            return redirect()->intended('/menu');
        }

        return back()->withErrors([
            'email' => config('message.login_fail'),
        ]);
    }
}
