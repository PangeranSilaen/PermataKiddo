<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mendapatkan data siswa
        $student1 = Student::where('nama_anak', 'Zahra Husein')->first();
        $student2 = Student::where('nama_anak', 'Bima Susanto')->first();
        $student3 = Student::where('nama_anak', 'Citra Hermawan')->first();

        // Membuat data pembayaran SPP untuk siswa 1
        Payment::create([
            'student_id' => $student1->id,
            'payment_type' => 'spp',
            'amount' => 500000,
            'payment_method' => 'bank_transfer',
            'payment_date' => '2025-04-10',
            'month' => 'april',
            'academic_year' => '2024/2025',
            'notes' => 'Pembayaran SPP bulan April 2025',
            'status' => 'paid',
        ]);

        // Membuat data pembayaran lainnya untuk siswa 2
        Payment::create([
            'student_id' => $student2->id,
            'payment_type' => 'other',
            'amount' => 300000,
            'payment_method' => 'cash',
            'payment_date' => '2025-04-15',
            'month' => 'april',
            'academic_year' => '2024/2025',
            'notes' => 'Pembayaran seragam sekolah',
            'status' => 'paid',
        ]);

        // Membuat data pembayaran SPP untuk siswa 3
        Payment::create([
            'student_id' => $student3->id,
            'payment_type' => 'spp',
            'amount' => 500000,
            'payment_method' => 'e_wallet',
            'payment_date' => '2025-04-20',
            'month' => 'april',
            'academic_year' => '2024/2025',
            'notes' => 'Pembayaran SPP bulan April 2025',
            'status' => 'paid',
        ]);
    }
}
