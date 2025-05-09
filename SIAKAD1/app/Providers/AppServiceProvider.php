<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Khusus untuk pembatasan resource Shield dan resource sensitif
        // Ini akan menolak semua akses ke resource yang mengandung kata kunci 'User', 'Role', 'Shield', 'Permission'
        Gate::before(function ($user, $ability) {
            // Jika user bukan admin/super_admin dan mencoba mengakses resource sensitif
            if (!$user->hasRole(['admin', 'super_admin'])) {
                // Cek apakah mencoba akses resource sensitif seperti User, Role, Permission, Shield
                $sensitiveResources = ['user', 'role', 'permission', 'shield'];
                
                foreach ($sensitiveResources as $resource) {
                    // Menolak jika ability mengandung nama resource sensitif
                    // Contoh: viewAny App\Filament\Resources\UserResource, view App\Filament\Resources\RoleResource, dll
                    if (Str::contains(strtolower($ability), $resource)) {
                        return false; // Tolak akses
                    }
                }
            }
            
            // Biarkan Gates lain mengambil keputusan authorization
            return null;
        });
    }
}
