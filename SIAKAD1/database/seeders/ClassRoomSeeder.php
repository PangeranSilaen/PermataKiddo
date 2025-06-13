<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassRoom;
use App\Models\Teacher;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua guru yang telah dibuat
        $teachers = Teacher::all();
        
        if ($teachers->isEmpty()) {
            // Jika belum ada guru, jalankan seeder guru terlebih dahulu
            $this->call(TeacherSeeder::class);
            $teachers = Teacher::all();
        }

        // Daftar kelas yang akan dibuat
        $classRooms = [
            [
                'name' => 'Kelas 1A',
                'teacher_id' => null, // akan diisi dengan ID guru Budi Santoso
                'academic_year' => '2024/2025',
                'description' => 'Kelas untuk murid kelas 1 kelompok A dengan fokus pada pengembangan dasar literasi dan numerasi.',
            ],
            [
                'name' => 'Kelas 1B',
                'teacher_id' => null, // akan diisi dengan ID guru Siti Nurhaliza
                'academic_year' => '2024/2025',
                'description' => 'Kelas untuk murid kelas 1 kelompok B dengan penekanan pada pengembangan keterampilan sosial.',
            ],
            [
                'name' => 'Kelas 2A',
                'teacher_id' => null, // akan diisi dengan ID guru Ahmad Rizki
                'academic_year' => '2024/2025',
                'description' => 'Kelas untuk murid kelas 2 kelompok A dengan fokus pada penguatan literasi dan numerasi.',
            ],
            [
                'name' => 'Kelas 2B',
                'teacher_id' => null, // akan diisi dengan ID guru Dewi Kartika
                'academic_year' => '2024/2025',
                'description' => 'Kelas untuk murid kelas 2 kelompok B dengan penekanan pada pengembangan kreativitas.',
            ],
            [
                'name' => 'Kelas 3A',
                'teacher_id' => null, // akan diisi dengan ID guru Rudi Hermawan
                'academic_year' => '2024/2025',
                'description' => 'Kelas untuk murid kelas 3 kelompok A dengan fokus pada penguatan kemampuan berpikir kritis.',
            ],
        ];

        // Mapping nama guru dengan kelas
        $teacherMapping = [
            'Kelas 1A' => 'Budi Santoso',
            'Kelas 1B' => 'Siti Nurhaliza',
            'Kelas 2A' => 'Ahmad Rizki',
            'Kelas 2B' => 'Dewi Kartika',
            'Kelas 3A' => 'Rudi Hermawan',
        ];

        // Assign teacher_id ke setiap kelas
        foreach ($classRooms as &$classRoom) {
            $teacherName = $teacherMapping[$classRoom['name']];
            $teacher = $teachers->firstWhere('name', $teacherName);
            
            if ($teacher) {
                $classRoom['teacher_id'] = $teacher->id;
            }
        }

        // Buat kelas-kelas
        foreach ($classRooms as $classRoomData) {
            // Cek apakah kelas sudah ada
            $existingClassRoom = ClassRoom::where('name', $classRoomData['name'])
                                         ->where('academic_year', $classRoomData['academic_year'])
                                         ->first();
            
            if (!$existingClassRoom && $classRoomData['teacher_id']) {
                ClassRoom::create($classRoomData);
            }
        }
    }
}