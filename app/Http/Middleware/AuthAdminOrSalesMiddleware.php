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
        // Verifica se o usuário está autenticado como 'admin' ou 'sales'
        if (Auth::guard('admin')->check()) {
            Auth::setDefaultDriver('admin'); // Define o guard admin
            return $next($request);
        } 
        
        if (Auth::guard('sales')->check()) {
            Auth::setDefaultDriver('sales'); // Define o guard sales
            return $next($request);
        }

        // Redireciona para o login correto com base na URL acessada
        return $this->redirectToCorrectLogin($request);
    }

    private function redirectToCorrectLogin(Request $request)
    {
        // Se a URL contém "admin", redirecionar para admin_login
        if ($request->is('admin/*')) {
            return redirect()->route('admin_login')->with('error', 'Acesso negado. Faça login como administrador.');
        }

        // Se a URL contém "sales", redirecionar para sales_login
        if ($request->is('sales/*')) {
            return redirect()->route('sales_login')->with('error', 'Acesso negado. Faça login como vendedor.');
        }

        // Padrão: Redireciona para login genérico se não encontrar um caso específico
        return redirect()->route('sales_login')->with('error', 'Acesso negado. Faça login.');
    }
}
