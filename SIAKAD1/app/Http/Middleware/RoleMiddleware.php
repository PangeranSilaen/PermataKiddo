<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        
        $user = Auth::user();
        
        // For parent dashboard, only allow parent role
        if ($role === 'parent' && $user->role !== 'parent') {
            if ($user->role === 'admin' || $user->role === 'super_admin') {
                return redirect('/admin');
            } elseif ($user->role === 'teacher') {
                return redirect('/teacher-dashboard');
            }
            abort(403, 'Unauthorized action.');
        }
        
        // For teacher dashboard, only allow teacher role
        if ($role === 'teacher' && $user->role !== 'teacher') {
            if ($user->role === 'admin' || $user->role === 'super_admin') {
                return redirect('/admin');
            } elseif ($user->role === 'parent') {
                return redirect('/parent-dashboard');
            }
            abort(403, 'Unauthorized action.');
        }
        
        return $next($request);
    }
}