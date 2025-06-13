<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Support\Str;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data murid yang sudah ada
        $students = Student::all();
        
        if ($students->isEmpty()) {
            // Jika belum ada murid, jalankan seeder murid terlebih dahulu
            $this->call(StudentSeeder::class);
            $students = Student::all();
        }

        // Daftar bulan dalam bahasa Inggris
        $months = [
            'january', 'february', 'march', 'april', 'may', 'june',
            'july', 'august', 'september', 'october', 'november', 'december'
        ];

        // Tanggal awal pembayaran
        $paymentDates = [
            'january' => '2024-01-10',
            'february' => '2024-02-10',
            'march' => '2024-03-10',
            'april' => '2024-04-10',
            'may' => '2024-05-10',
            'june' => '2024-06-10',
        ];

        // Status pembayaran
        $statuses = ['paid', 'paid', 'paid', 'paid', 'pending', 'pending'];

        // Metode pembayaran
        $paymentMethods = ['cash', 'bank_transfer', 'e_wallet', 'credit_card'];

        // Buat pembayaran untuk setiap murid dan bulan
        foreach ($students as $student) {
            // Hanya buat pembayaran untuk bulan Januari sampai Juni
            for ($i = 0; $i < 6; $i++) {
                $month = $months[$i];
                $status = $statuses[$i];
                $paymentDate = $paymentDates[$month];
                $paymentMethod = $status === 'paid' ? $paymentMethods[array_rand($paymentMethods)] : null;
                
                // Nominal pembayaran sesuai dengan kelas
                $amount = 500000; // Default
                if (strpos($student->classRoom->name ?? '', '1') !== false) {
                    $amount = 500000; // Kelas 1
                } elseif (strpos($student->classRoom->name ?? '', '2') !== false) {
                    $amount = 550000; // Kelas 2
                } elseif (strpos($student->classRoom->name ?? '', '3') !== false) {
                    $amount = 600000; // Kelas 3
                }

                // Generate receipt number
                $receiptNumber = $status === 'paid' 
                    ? 'SPP-' . strtoupper(substr($month, 0, 3)) . '-' . substr(str_pad($student->id, 3, '0', STR_PAD_LEFT), -3)
                    : null;
                
                // Buat data pembayaran
                Payment::create([
                    'student_id' => $student->id,
                    'payment_type' => 'spp',
                    'receipt_number' => $receiptNumber,
                    'amount' => $amount,
                    'payment_date' => $status === 'paid' ? $paymentDate : null,
                    'payment_method' => $paymentMethod,
                    'month' => $month,
                    'academic_year' => '2024/2025',
                    'status' => $status,
                    'notes' => 'Pembayaran SPP bulan ' . ucfirst($month) . ' tahun ajaran 2024/2025',
                ]);
            }
        }
    }
}