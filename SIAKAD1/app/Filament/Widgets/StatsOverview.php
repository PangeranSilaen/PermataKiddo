<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Payment;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Siswa', Student::count())
                ->description('Jumlah siswa terdaftar')
                // ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),
            
            Stat::make('Total Guru', Teacher::count())
                ->description('Jumlah guru aktif')
                // ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),
            
            Stat::make('Total Pengguna', User::count())
                ->description('Semua pengguna sistem')
                // ->descriptionIcon('heroicon-m-users')
                ->color('warning'),
            
            Stat::make('Pembayaran Bulan Ini', 'Rp ' . number_format(Payment::whereMonth('created_at', now()->month)->sum('amount'), 0, ',', '.'))
                ->description('Total pembayaran bulan ' . now()->format('F'))
                // ->descriptionIcon('heroicon-m-banknotes')
                ->color('danger'),
        ];
    }
}
