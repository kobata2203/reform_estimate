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
        if (Auth::check()) {
            $user = Auth::user();
            $lastActivityKey = 'last_activity_' . $user->role; 
            
            $lastActivity = session($lastActivityKey);

            if ($lastActivity && Carbon::parse($lastActivity)->diffInMinutes(now()) >= 120) {
                Auth::logout();

                session()->flush();

                if ($user->role === 'admin') {
                    return redirect('/admin/login')->with('message', 'Sessão expirada. Faça login novamente.');
                }

                return redirect('/sales/login')->with('message', 'Sessão expirada. Faça login novamente.');
            }

            session([$lastActivityKey => now()]);
        }

        return $next($request);
    }
}
