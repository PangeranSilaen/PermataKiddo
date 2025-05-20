<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectFilamentLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika request ke /admin/login dan user belum login,
        // redirect ke halaman login utama di /login
        if ($request->is('admin/login') && !Auth::check()) {
            return redirect('/login');
        }

        return $next($request);
    }
}