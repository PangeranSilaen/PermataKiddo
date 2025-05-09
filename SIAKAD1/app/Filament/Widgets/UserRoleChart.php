<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class UserRoleChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Pengguna Berdasarkan Role';
    
    // Set sort order to appear alongside payment chart
    protected static ?int $sort = 21;
    
    // Set column span to take half the width
    protected int | string | array $columnSpan = ['lg' => 1, 'xl' => 1];
    
    // Auto-refresh setiap 30 menit
    protected static ?string $pollingInterval = '30m';
    
    protected function getData(): array
    {
        // Ambil data distribusi role dari tabel users
        $roleDistribution = User::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->get()
            ->mapWithKeys(function ($item) {
                // Buat label role lebih mudah dibaca (capitalize)
                $roleLabel = ucfirst($item->role ?: 'Undefined');
                return [$roleLabel => $item->total];
            })
            ->toArray();
            
        // Jika tidak ada data, beri contoh data
        if (empty($roleDistribution)) {
            $roleDistribution = [
                'Admin' => 1,
                'Teacher' => 2,
                'Parent' => 3,
            ];
        }
        
        // Warna untuk setiap role
        $backgroundColors = [
            'Admin' => '#f44336',        // Merah
            'Super_admin' => '#9c27b0',  // Ungu
            'Teacher' => '#4caf50',      // Hijau
            'Parent' => '#2196f3',       // Biru
            'Tester' => '#ff9800',       // Oranye
            'Undefined' => '#9e9e9e',    // Abu-abu
            // Warna default untuk role lain
            'default' => '#607d8b',      // Blue Grey
        ];
        
        // Siapkan warna untuk setiap role
        $colors = [];
        foreach ($roleDistribution as $role => $count) {
            $colors[] = $backgroundColors[$role] ?? $backgroundColors['default'];
        }
        
        return [
            'datasets' => [
                [
                    'label' => 'Pengguna',
                    'data' => array_values($roleDistribution),
                    'backgroundColor' => $colors,
                    'borderColor' => '#ffffff',
                    'borderWidth' => 2,
                    'hoverOffset' => 10,
                ],
            ],
            'labels' => array_keys($roleDistribution),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
    
    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'position' => 'right',
                ],
                'tooltip' => [
                    'callbacks' => [
                        'label' => "function(context) {
                            let label = context.label || '';
                            let value = context.formattedValue;
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = Math.round((context.raw / total) * 100);
                            return label + ': ' + value + ' (' + percentage + '%)';
                        }",
                    ],
                ],
            ],
        ];
    }
}