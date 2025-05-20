<?php

namespace App\Http\Controllers;

use Filament\Pages\Auth\Logout as FilamentLogout;
use Illuminate\Support\Facades\Auth;

class CustomFilamentLogoutController extends Controller
{
    public function __invoke()
    {
        Auth::logout();
        
        session()->invalidate();
        session()->regenerateToken();
        
        return redirect('/login');
    }
}