<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {

        if ($request->session()->exists('logado')) {
            if (intval($request->session()->get('logado')) == 0) {
                return redirect()->to('/auth/login')->withErrors("Login Expirado");
            }else{
                 return $next($request);
            }
        } else {
            return redirect()->to('/auth/login')->withErrors("Login Expirado");
        }
    }
}
