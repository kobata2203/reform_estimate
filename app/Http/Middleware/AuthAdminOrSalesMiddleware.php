<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAdminOrSalesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->check()) {
            Auth::setDefaultDriver('admin');

            return $next($request);
        }

        if (Auth::guard('sales')->check()) {
            Auth::setDefaultDriver('sales');

            return $next($request);
        }

        return $this->redirectToCorrectLogin($request);
    }

    private function redirectToCorrectLogin(Request $request)
    {
        $errorMessageAdmin = config('message.only_admin_access');
        $errorMessageSales = config('message.only_sales_access');

        if ($request->is('admin/*')) {

            return redirect()->route('admin_login')->with('error', $errorMessageAdmin);
        }

        if ($request->is('sales/*')) {

            return redirect()->route('sales_login')->with('error', $errorMessageSales);
        }

        return redirect()->route('sales_login')->with('error', $errorMessageSales);
    }
}
