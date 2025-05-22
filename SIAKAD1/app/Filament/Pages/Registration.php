<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Registration extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Daftar Siswa Baru';
    protected static ?string $title = 'Pendaftaran Siswa Baru';
    
    // Menonaktifkan navigasi
    protected static bool $shouldRegisterNavigation = false;
    
    protected static string $view = 'filament.pages.registration';
    
    public static function canAccess(): bool
    {
        return false; // Tidak dapat diakses oleh siapapun
    }
}
