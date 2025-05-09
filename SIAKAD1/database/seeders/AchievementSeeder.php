<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
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

        // Mendapatkan data guru
        $teacher1 = Teacher::where('employee_id', 'EMP001')->first();
        $teacher2 = Teacher::where('employee_id', 'EMP002')->first();
        $teacher3 = Teacher::where('employee_id', 'EMP003')->first();

        // Membuat data capaian pembelajaran untuk siswa 1
        Achievement::create([
            'student_id' => $student1->id,
            'teacher_id' => $teacher1->id,
            'period' => 'Semester 1',
            'academic_year' => '2024/2025',
            'subject' => 'Matematika',
            'achievement_description' => 'Mampu mengenal angka 1-10 dengan baik dan dapat melakukan operasi penjumlahan sederhana',
            'score' => 'A',
            'notes' => 'Siswa menunjukkan kemampuan matematika yang baik dan antusias dalam belajar',
            'date_recorded' => '2025-04-15',
        ]);

        // Membuat data capaian pembelajaran untuk siswa 2
        Achievement::create([
            'student_id' => $student2->id,
            'teacher_id' => $teacher2->id,
            'period' => 'Semester 1',
            'academic_year' => '2024/2025',
            'subject' => 'Seni',
            'achievement_description' => 'Menunjukkan kreativitas dalam menggambar dan melukis dengan berbagai media',
            'score' => 'A-',
            'notes' => 'Siswa sangat kreatif dalam kegiatan seni, perlu didorong untuk lebih berani mencoba teknik baru',
            'date_recorded' => '2025-04-16',
        ]);

        // Membuat data capaian pembelajaran untuk siswa 3
        Achievement::create([
            'student_id' => $student3->id,
            'teacher_id' => $teacher3->id,
            'period' => 'Semester 1',
            'academic_year' => '2024/2025',
            'subject' => 'Bahasa',
            'achievement_description' => 'Dapat mengenal huruf A-Z dan mampu mengeja kata-kata sederhana',
            'score' => 'B+',
            'notes' => 'Siswa menunjukkan perkembangan yang baik, perlu lebih banyak latihan membaca di rumah',
            'date_recorded' => '2025-04-17',
        ]);
    }
}
