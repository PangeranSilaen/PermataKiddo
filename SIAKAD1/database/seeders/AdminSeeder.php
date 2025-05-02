<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Memastikan roles sudah dibuat
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin', 'guard_name' => 'web']);
        }
        if (!Role::where('name', 'super_admin')->exists()) {
            Role::create(['name' => 'super_admin', 'guard_name' => 'web']);
        }
        if (!Role::where('name', 'teacher')->exists()) {
            Role::create(['name' => 'teacher', 'guard_name' => 'web']);
        }
        if (!Role::where('name', 'parent')->exists()) {
            Role::create(['name' => 'parent', 'guard_name' => 'web']);
        }

        // Membuat data admin baru
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@permatakiddo.com',
            'password' => Hash::make('admin123'), // Ganti dengan password yang aman
            'role' => 'super_admin', // Set kolom role secara langsung
        ]);

        // Menambahkan role admin dan super_admin ke user
        $admin->assignRole(['admin', 'super_admin']);
    }
}
