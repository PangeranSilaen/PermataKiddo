<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;
use App\Models\Student;
use App\Models\Teacher;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data murid dan guru yang sudah ada
        $students = Student::all();
        $teachers = Teacher::all();
        
        if ($students->isEmpty() || $teachers->isEmpty()) {
            // Jika data murid atau guru belum ada, jalankan seeder terlebih dahulu
            $this->call([
                TeacherSeeder::class,
                ClassRoomSeeder::class,
                StudentSeeder::class,
            ]);
            
            $students = Student::all();
            $teachers = Teacher::all();
        }

        // Daftar opsi capaian yang tersedia
        $achievementOptions = [
            'capaian_1' => 'Kemampuan membaca dan menulis dasar',
            'capaian_2' => 'Kemampuan berhitung dasar',
            'capaian_3' => 'Kemampuan berbahasa Indonesia',
            'capaian_4' => 'Kemampuan berbahasa Inggris dasar',
            'capaian_5' => 'Kemampuan berinteraksi sosial',
            'capaian_6' => 'Kemampuan kreativitas dan seni',
            'capaian_7' => 'Kemampuan motorik kasar',
            'capaian_8' => 'Kemampuan motorik halus',
        ];

        // Data capaian untuk setiap murid
        $achievementsData = [
            // Capaian untuk murid di Kelas 1A
            [
                'student_name' => 'Farhan Fauzi',
                'teacher_specialization' => 'Bahasa Indonesia',
                'achievements' => ['capaian_1', 'capaian_3', 'capaian_5'],
                'achievement_date' => '2024-05-20',
                'semester' => '1',
                'academic_year' => '2024/2025',
            ],
            [
                'student_name' => 'Amelia Ratna',
                'teacher_specialization' => 'Bahasa Indonesia',
                'achievements' => ['capaian_1', 'capaian_3', 'capaian_6'],
                'achievement_date' => '2024-05-20',
                'semester' => '1',
                'academic_year' => '2024/2025',
            ],
            
            // Capaian untuk murid di Kelas 1B
            [
                'student_name' => 'Bima Surya',
                'teacher_specialization' => 'Matematika',
                'achievements' => ['capaian_2', 'capaian_5', 'capaian_8'],
                'achievement_date' => '2024-05-21',
                'semester' => '1',
                'academic_year' => '2024/2025',
            ],
            [
                'student_name' => 'Citra Wijaya',
                'teacher_specialization' => 'Matematika',
                'achievements' => ['capaian_2', 'capaian_6', 'capaian_8'],
                'achievement_date' => '2024-05-21',
                'semester' => '1',
                'academic_year' => '2024/2025',
            ],
            
            // Capaian untuk murid di Kelas 2A
            [
                'student_name' => 'Dika Prakoso',
                'teacher_specialization' => 'Ilmu Pengetahuan Alam',
                'achievements' => ['capaian_1', 'capaian_2', 'capaian_3', 'capaian_5'],
                'achievement_date' => '2024-05-22',
                'semester' => '1',
                'academic_year' => '2024/2025',
            ],
            [
                'student_name' => 'Erika Sari',
                'teacher_specialization' => 'Ilmu Pengetahuan Alam',
                'achievements' => ['capaian_1', 'capaian_2', 'capaian_3', 'capaian_6'],
                'achievement_date' => '2024-05-22',
                'semester' => '1',
                'academic_year' => '2024/2025',
            ],
            
            // Capaian untuk murid di Kelas 2B
            [
                'student_name' => 'Fajar Susilo',
                'teacher_specialization' => 'Bahasa Inggris',
                'achievements' => ['capaian_1', 'capaian_3', 'capaian_4', 'capaian_5'],
                'achievement_date' => '2024-05-23',
                'semester' => '1',
                'academic_year' => '2024/2025',
            ],
            [
                'student_name' => 'Gita Hartati',
                'teacher_specialization' => 'Bahasa Inggris',
                'achievements' => ['capaian_1', 'capaian_3', 'capaian_4', 'capaian_6'],
                'achievement_date' => '2024-05-23',
                'semester' => '1',
                'academic_year' => '2024/2025',
            ],
            
            // Capaian untuk murid di Kelas 3A
            [
                'student_name' => 'Hadi Nugroho',
                'teacher_specialization' => 'Pendidikan Jasmani',
                'achievements' => ['capaian_5', 'capaian_7', 'capaian_8'],
                'achievement_date' => '2024-05-24',
                'semester' => '1',
                'academic_year' => '2024/2025',
            ],
            [
                'student_name' => 'Indah Astuti',
                'teacher_specialization' => 'Pendidikan Jasmani',
                'achievements' => ['capaian_5', 'capaian_6', 'capaian_7'],
                'achievement_date' => '2024-05-24',
                'semester' => '1',
                'academic_year' => '2024/2025',
            ],
        ];

        // Buat data capaian
        foreach ($achievementsData as $achievementData) {
            // Cari murid berdasarkan nama
            $student = $students->firstWhere('name', $achievementData['student_name']);
            
            // Cari guru berdasarkan spesialisasi
            $teacher = $teachers->firstWhere('specialization', $achievementData['teacher_specialization']);
            
            if ($student && $teacher) {
                // Buat data achievement
                Achievement::create([
                    'student_id' => $student->id,
                    'teacher_id' => $teacher->id,
                    'achievements' => $achievementData['achievements'],
                    'achievement_date' => $achievementData['achievement_date'],
                    'semester' => $achievementData['semester'],
                    'academic_year' => $achievementData['academic_year'],
                ]);
            }
        }
    }
}