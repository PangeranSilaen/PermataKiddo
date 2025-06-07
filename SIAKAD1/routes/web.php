<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ParentRegistrationController;
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

// Redirect admin/login ke /login
Route::get('/admin/login', function() {
    return redirect('/login');
})->middleware('guest')->name('filament.admin.auth.login');

// Dashboard Routes (Protected)
Route::middleware('auth')->group(function () {
    // Parent Dashboard - only accessible by parents
    Route::get('/parent-dashboard', function () {
        $user = \Illuminate\Support\Facades\Auth::user();
        // Ambil semua anak milik user (parent)
        $students = \App\Models\Student::where('parent_name', $user->name)
            ->orWhere('user_id', $user->id)
            ->with(['achievements'])
            ->get();
        return view('parent.dashboard', compact('students'));
    })->middleware(RoleMiddleware::class . ':parent')->name('parent.dashboard');
    
    // Redirect teachers to admin panel
    Route::get('/teacher-dashboard', function () {
        return redirect('/admin');
    })->middleware(RoleMiddleware::class . ':teacher')->name('teacher.dashboard');

    // Override Filament Logout Route
    Route::get('/admin/logout', [App\Http\Controllers\CustomFilamentLogoutController::class, '__invoke'])->name('filament.admin.auth.logout');

    // Parent Registration Page
    Route::middleware(['auth'])->get('/pendaftaran-anak', function () {
        return app(\App\Filament\Pages\Registration::class);
    })->name('parent.registration');

    // Parent Payment Page
    Route::middleware(['auth'])->get('/parent/pay/{payment}', [PaymentController::class, 'pay'])->name('parent.pay');
    Route::middleware(['auth'])->post('/parent/pay/{payment}/confirm', [PaymentController::class, 'confirm'])->name('parent.pay.confirm');

    // Parent Custom Registration Form
    Route::middleware(['auth'])->get('/parent/register', [ParentRegistrationController::class, 'showForm'])->name('parent.register');
    Route::middleware(['auth'])->post('/parent/register', [ParentRegistrationController::class, 'submit'])->name('parent.register.submit');

    // Detail Capaian Pembelajaran Anak
    Route::get('/parent/achievement/{achievement}', function ($achievementId) {
        $achievement = \App\Models\Achievement::with(['student', 'teacher'])->findOrFail($achievementId);
        // Opsional: validasi agar hanya parent dari anak terkait yang bisa akses
        if (auth()->user()->id !== ($achievement->student->user_id ?? null) && auth()->user()->name !== ($achievement->student->parent_name ?? null)) {
            abort(403);
        }
        return view('parent.achievement-detail', compact('achievement'));
    })->middleware(RoleMiddleware::class . ':parent')->name('parent.achievement.detail');
});
