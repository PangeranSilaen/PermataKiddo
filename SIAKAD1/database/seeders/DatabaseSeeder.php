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
        // Jalankan hanya AdminSeeder dan UserSeeder
        $this->call([
            // Pertama buat admin dan role
            AdminSeeder::class,
            
            // Buat user (parent dan teacher)
            UserSeeder::class,
        ]);
    }
}
