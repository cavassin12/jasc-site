<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

class AuthMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        
//        return $next($request);
        if (str_contains("painel", $request->fullUrl())) {
            if ($request->session()->exists('logado')) {
                if (intval($request->session()->get('logado')) == 0) {
                    return redirect()->to('/auth/login')->withErrors("Login Expirado");
                } else {
                    return $next($request);
                }
            }
            return redirect()->to('/')->withErrors("Login Expirado");
        } else {
            return $next($request);
        }
    }
}
