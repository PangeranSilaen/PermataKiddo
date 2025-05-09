<?php

namespace App\Filament\Resources\PaymentResource\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class PaymentChart extends ChartWidget
{
    protected static ?string $heading = 'Tren Pembayaran Bulanan';
    
    // Chart akan dirender ulang setiap 15 menit
    protected static ?string $pollingInterval = '15m';
    
    // Mengizinkan chart difilter berdasarkan tanggal
    protected function getFilters(): ?array
    {
        return [
            'tahun_ini' => 'Tahun Ini',
            '12_bulan_terakhir' => '12 Bulan Terakhir',
            '6_bulan_terakhir' => '6 Bulan Terakhir',
            '3_bulan_terakhir' => '3 Bulan Terakhir',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $months = match ($activeFilter) {
            'tahun_ini' => Carbon::now()->month,
            '12_bulan_terakhir' => 12,
            '6_bulan_terakhir' => 6,
            '3_bulan_terakhir' => 3,
            default => Carbon::now()->month,
        };

        $data = [];
        $labels = [];
        $colors = ['#36a2eb', '#fd7e14']; // Biru dan oranye
        
        // Data pembayaran
        for ($i = $months - 1; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->translatedFormat('M Y'); // Format bulan dalam bahasa
            
            // Nominal pembayaran per bulan (dalam juta Rupiah)
            $monthlyTotal = Payment::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->sum('amount');
                
            $data[] = $monthlyTotal / 1000000; // Konversi ke juta Rp untuk tampilan lebih baik
        }
        
        // Data jumlah transaksi/pembayaran
        $transactionCount = [];
        for ($i = $months - 1; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            
            // Menghitung jumlah transaksi pembayaran per bulan
            $count = Payment::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();
                
            $transactionCount[] = $count;
        }
        
        return [
            'datasets' => [
                [
                    'label' => 'Total Pembayaran (Juta Rp)',
                    'data' => $data,
                    'borderColor' => $colors[0],
                    'backgroundColor' => 'rgba(54, 162, 235, 0.1)',
                    'fill' => true,
                    'tension' => 0.2, // Membuat line sedikit melengkung
                ],
                [
                    'label' => 'Jumlah Transaksi',
                    'data' => $transactionCount,
                    'borderColor' => $colors[1],
                    'backgroundColor' => 'rgba(253, 126, 20, 0.1)',
                    'fill' => true,
                    'tension' => 0.2,
                    'yAxisID' => 'y1', // Menggunakan sumbu Y kedua untuk skala berbeda
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
    
    // Konfigurasi chart dengan 2 sumbu Y berbeda
    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Nominal (Juta Rp)',
                    ],
                    'beginAtZero' => true,
                ],
                'y1' => [
                    'position' => 'right',
                    'title' => [
                        'display' => true,
                        'text' => 'Jumlah Transaksi',
                    ],
                    'beginAtZero' => true,
                    'grid' => [
                        'drawOnChartArea' => false,
                    ],
                ],
            ],
            'elements' => [
                'line' => [
                    'fill' => true,
                ],
                'point' => [
                    'radius' => 4,
                    'hoverRadius' => 6,
                ],
            ],
        ];
    }
}
