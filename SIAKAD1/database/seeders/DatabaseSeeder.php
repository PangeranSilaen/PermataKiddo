<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat role dasar
        $roles = ['super_admin', 'admin', 'teacher', 'parent'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Jalankan semua seeder
        $this->call([
            AdminSeeder::class,
            TeacherSeeder::class,
            ClassRoomSeeder::class,
            StudentSeeder::class,
            ScheduleSeeder::class,
            AchievementSeeder::class,
            // PaymentSeeder::class,
        ]);
    }
}
