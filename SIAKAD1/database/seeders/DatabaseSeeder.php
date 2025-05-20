<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan semua seeder secara berurutan dengan memperhatikan dependensi
        $this->call([
            // Pertama buat admin dan role
            AdminSeeder::class,
            
            // Buat user (parent)
            UserSeeder::class,
            
            // Buat guru
            TeacherSeeder::class,
            
            // Buat kelas (membutuhkan guru)
            ClassRoomSeeder::class,
            
            // Buat pendaftaran siswa (membutuhkan parent/user)
            RegistrationSeeder::class,
            
            // Buat siswa (idealnya setelah registrasi)
            StudentSeeder::class,
            
            // Buat jadwal (membutuhkan kelas dan guru)
            ScheduleSeeder::class,
            
            // Buat pembayaran (membutuhkan siswa)
            PaymentSeeder::class,
            
            // Buat prestasi (membutuhkan siswa)
            AchievementSeeder::class,
        ]);
    }
}
