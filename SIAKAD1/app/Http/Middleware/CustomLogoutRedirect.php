<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomLogoutRedirect
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
        // Mendapatkan respons dari middleware berikutnya
        $response = $next($request);

        // Jika ini adalah request logout dan user sudah tidak terautentikasi
        if ($request->is('admin/logout') && !Auth::check()) {
            // Redirect ke /login untuk semua user yang logout dari Filament
            return redirect('/login');
        }

        return $response;
    }
}