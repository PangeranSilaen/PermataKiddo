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
        // Jalankan semua seeder secara berurutan
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
            ScheduleSeeder::class,
            PaymentSeeder::class,
            AchievementSeeder::class,
        ]);
    }
}
