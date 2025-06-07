<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user dengan role teacher
        $teachers = User::where('role', 'teacher')->get();
        $specializations = ['Matematika', 'Bahasa Indonesia', 'IPA'];
        $i = 0;
        foreach ($teachers as $user) {
            Teacher::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'name' => $user->name,
                'employee_id' => 'EMP' . str_pad($user->id, 4, '0', STR_PAD_LEFT),
                'specialization' => $specializations[$i % count($specializations)],
                'phone_number' => $user->phone ?? '08111111111',
                'address' => 'Alamat Guru ' . $user->name,
                'photo' => null,
                'join_date' => now(),
                'status' => 'active',
                'bio' => 'Guru ' . $specializations[$i % count($specializations)],
            ]);
            $i++;
        }
    }
}
