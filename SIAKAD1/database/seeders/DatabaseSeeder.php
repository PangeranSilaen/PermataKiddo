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
        // Jalankan AdminSeeder untuk membuat akun admin dan roles
        $this->call([
            AdminSeeder::class,
        ]);

        // Tambahkan seeder lain di masa depan jika diperlukan
    }
}
