<?php

namespace App\Http\Controllers\Auth\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthSaleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthSaleController extends Controller
{
    protected $role;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->role = User::ROLE_SALES;
        $this->middleware('guest:sales')->except('logout');
        $this->middleware('auth:sales')->only('logout');
    }

    protected function redirectPath()
    {
        return '/menu'; // ログイン後にリダイレクトする URL を指定
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('sales.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('sales')->attempt(array_merge($credentials, ['role' => User::ROLE_SALES]))) {
            $request->session()->regenerate();
            return redirect()->route('menu');
        }
    
        return back()->withErrors(['email' => 'Credenciais incorretas para vendedor.']);
    }
    

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('sales')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('sales_login');
    }

    // 以下は、`AuthenticatesUsers` トレイトからオーバーライドされたメソッド

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only('email', 'password', 'role');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                        ?: redirect($this->redirectPath());
    }


    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $request->session()->flash('error', trans('auth.failed'));

        return redirect()->back()
                         ->withInput($request->only($this->username(), 'remember'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('sales');
    }
}
