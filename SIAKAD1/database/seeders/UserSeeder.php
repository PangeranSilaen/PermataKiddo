<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat user dengan peran teacher
        $teacher1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.teacher@permatakiddo.com',
            'password' => Hash::make('password123'),
            'role' => 'teacher',
            'gender' => 'male',
            'phone' => '081234567890',
        ]);
        $teacher1->assignRole('teacher');

        $teacher2 = User::create([
            'name' => 'Siti Rahma',
            'email' => 'siti.teacher@permatakiddo.com',
            'password' => Hash::make('password123'),
            'role' => 'teacher',
            'gender' => 'female',
            'phone' => '081234567891',
        ]);
        $teacher2->assignRole('teacher');

        $teacher3 = User::create([
            'name' => 'Andi Wijaya',
            'email' => 'andi.teacher@permatakiddo.com',
            'password' => Hash::make('password123'),
            'role' => 'teacher',
            'gender' => 'male',
            'phone' => '081234567892',
        ]);
        $teacher3->assignRole('teacher');

        // Membuat user dengan peran parent
        $parent1 = User::create([
            'name' => 'Ahmad Husein',
            'email' => 'ahmad.parent@permatakiddo.com',
            'password' => Hash::make('password123'),
            'role' => 'parent',
            'gender' => 'male',
            'phone' => '081234567893',
        ]);
        $parent1->assignRole('parent');

        $parent2 = User::create([
            'name' => 'Dewi Susanti',
            'email' => 'dewi.parent@permatakiddo.com',
            'password' => Hash::make('password123'),
            'role' => 'parent',
            'gender' => 'female',
            'phone' => '081234567894',
        ]);
        $parent2->assignRole('parent');

        $parent3 = User::create([
            'name' => 'Rudi Hermawan',
            'email' => 'rudi.parent@permatakiddo.com',
            'password' => Hash::make('password123'),
            'role' => 'parent',
            'gender' => 'male',
            'phone' => '081234567895',
        ]);
        $parent3->assignRole('parent');
    }
}
