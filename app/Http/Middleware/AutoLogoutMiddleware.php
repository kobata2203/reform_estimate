<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AutoLogoutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (Auth::check()) {
        //     $user = Auth::user();
        //     $lastActivityKey = 'last_activity_' . $user->role;

        //     $lastActivity = session($lastActivityKey);

        //     if ($lastActivity && Carbon::parse($lastActivity)->diffInMinutes(now()) >= 1) {
        //         Auth::logout();

        //         session()->flush();

        //         if ($user->role === 'admin') {
        //             return redirect('/admin/login')->with('message', 'セッションの有効期限が切れました。再度ログインしてください。');
        //         }

        //         return redirect('/sales/login')->with('message', 'セッションの有効期限が切れました。再度ログインしてください。');
        //     }

        //     session([$lastActivityKey => now()]);
        // }
        if (Auth::guard('sales')->check()) {
            return $this->checkSessionTimeout($request, $next, 'sales', '/sales/login');
        }

        if (Auth::guard('admin')->check()) {
            return $this->checkSessionTimeout($request, $next, 'admin', '/admin/login');
        }
        return $next($request);
    }

    private function checkSessionTimeout(Request $request, Closure $next, string $role, string $redirectPath)
    {
        $user = Auth::guard($role)->user();
        $lastActivityKey = 'last_activity_' . $role;
        $lastActivity = session($lastActivityKey);

        if ($lastActivity && Carbon::parse($lastActivity)->diffInMinutes(now()) >= 1) {
            Auth::guard($role)->logout();
            session()->flush();
            return redirect($redirectPath)->with('message', 'セッションの有効期限が切れました。再度ログインしてください。');
        }

        session([$lastActivityKey => now()]);
        return $next($request);
    }
}
