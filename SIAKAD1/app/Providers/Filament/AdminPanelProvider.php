<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use App\Filament\Resources\UserResource;
use Illuminate\Support\Facades\Gate;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        // Register explicit gates untuk resource sensitif
        Gate::define('view_any_user', function ($user) {
            return $user->hasRole(['admin', 'super_admin']);
        });
        Gate::define('view_user', function ($user) {
            return $user->hasRole(['admin', 'super_admin']);
        });
        Gate::define('create_user', function ($user) {
            return $user->hasRole(['admin', 'super_admin']);
        });
        Gate::define('update_user', function ($user) {
            return $user->hasRole(['admin', 'super_admin']);
        });
        Gate::define('delete_user', function ($user) {
            return $user->hasRole(['admin', 'super_admin']);
        });

        return $panel
            ->default()
            ->brandName('PermataKiddo')
            ->sidebarCollapsibleOnDesktop(true)
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Pink,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->resources([
                \App\Filament\Resources\RegistrationResource::class,
                // Sumber daya lain yang sudah ada...
            ])
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                \App\Filament\Widgets\StatsOverview::class,
                // Moving payment stats and user role chart to the bottom
                // Widgets\FilamentInfoWidget::class,
                \App\Filament\Widgets\UserRoleChart::class,
                \App\Filament\Widgets\PaymentOverviewChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ]);
    }
}