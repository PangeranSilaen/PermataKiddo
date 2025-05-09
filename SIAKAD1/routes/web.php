<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes (Protected)
Route::middleware('auth')->group(function () {
    // Parent Dashboard - only accessible by parents
    Route::get('/parent-dashboard', function () {
        return view('parent.dashboard');
    })->middleware(RoleMiddleware::class . ':parent')->name('parent.dashboard');
    
    // Redirect teachers to admin panel
    Route::get('/teacher-dashboard', function () {
        return redirect('/admin');
    })->middleware(RoleMiddleware::class . ':teacher')->name('teacher.dashboard');
});
