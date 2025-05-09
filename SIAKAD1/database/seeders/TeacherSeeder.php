<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mendapatkan user dengan peran teacher
        $teacherUser1 = User::where('email', 'budi.teacher@permatakiddo.com')->first();
        $teacherUser2 = User::where('email', 'siti.teacher@permatakiddo.com')->first();
        $teacherUser3 = User::where('email', 'andi.teacher@permatakiddo.com')->first();

        // Membuat data guru terkait dengan user teacher
        Teacher::create([
            'user_id' => $teacherUser1->id,
            'name' => $teacherUser1->name,
            'employee_id' => 'EMP001',
            'specialization' => 'Matematika',
            'phone_number' => $teacherUser1->phone,
            'address' => 'Jl. Pendidikan No. 123, Jakarta',
            'join_date' => '2024-01-15',
            'status' => 'active',
            'bio' => 'Berpengalaman mengajar matematika untuk anak-anak selama 5 tahun.',
        ]);

        Teacher::create([
            'user_id' => $teacherUser2->id,
            'name' => $teacherUser2->name,
            'employee_id' => 'EMP002',
            'specialization' => 'Seni',
            'phone_number' => $teacherUser2->phone,
            'address' => 'Jl. Kreatif No. 45, Jakarta',
            'join_date' => '2024-02-20',
            'status' => 'active',
            'bio' => 'Spesialis dalam mengembangkan kreativitas anak melalui seni dan kerajinan tangan.',
        ]);

        Teacher::create([
            'user_id' => $teacherUser3->id,
            'name' => $teacherUser3->name,
            'employee_id' => 'EMP003',
            'specialization' => 'Bahasa',
            'phone_number' => $teacherUser3->phone,
            'address' => 'Jl. Bahasa No. 78, Jakarta',
            'join_date' => '2024-03-10',
            'status' => 'active',
            'bio' => 'Fokus pada pengembangan kemampuan berbahasa dan komunikasi untuk anak usia dini.',
        ]);
    }
}
