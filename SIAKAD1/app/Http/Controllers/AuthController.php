<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            
            // Check role based on the 'role' field rather than hasRole method
            if ($user->role === 'admin' || $user->role === 'super_admin') {
                return redirect('/admin');
            } elseif ($user->role === 'teacher') {
                return redirect('/teacher-dashboard');
            } elseif ($user->role === 'parent') {
                return redirect('/parent-dashboard');
            } else {
                // Fallback - redirect to login with a message
                Auth::logout();
                return redirect()->route('login')
                    ->withErrors(['email' => 'Your account does not have a valid role.']);
            }
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|in:male,female',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'parent',
        ]);
        
        $user->assignRole('parent');
        
        Auth::login($user);
        
        return redirect('/parent-dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}
