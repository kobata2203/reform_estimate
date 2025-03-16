<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AutoLogoutMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
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
        $lastActivityKey = 'last_activity_' . $role;
        $lastActivity = session($lastActivityKey);
        $autoLogoutTime = config('util.auto_logout_time');

        if ($lastActivity && Carbon::parse($lastActivity)->diffInMinutes(now()) >= $autoLogoutTime) {
            Auth::guard($role)->logout();
            session()->flush();
            $logoutMessage = config('message.auto_logout');

            return redirect($redirectPath)->with('logout_message', $logoutMessage);
        }

        session([$lastActivityKey => now()]);

        return $next($request);
    }
}
