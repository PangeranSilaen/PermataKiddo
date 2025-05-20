<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Pastikan ada data guru untuk ditugaskan sebagai wali kelas
        $teachers = Teacher::all();
        
        if ($teachers->isEmpty()) {
            // Jika tidak ada guru, buat kelas tanpa wali kelas
            $this->createClassRoomsWithoutTeachers();
        } else {
            // Jika ada guru, buat kelas dengan wali kelas
            $this->createClassRoomsWithTeachers($teachers);
        }
    }

    /**
     * Buat kelas-kelas tanpa wali kelas
     */
    private function createClassRoomsWithoutTeachers(): void
    {
        $classes = [
            ['name' => 'Kelas A1', 'level' => 'TK A', 'capacity' => 20],
            ['name' => 'Kelas A2', 'level' => 'TK A', 'capacity' => 20],
            ['name' => 'Kelas B1', 'level' => 'TK B', 'capacity' => 25],
            ['name' => 'Kelas B2', 'level' => 'TK B', 'capacity' => 25],
            ['name' => 'Playgroup 1', 'level' => 'PG', 'capacity' => 15],
            ['name' => 'Playgroup 2', 'level' => 'PG', 'capacity' => 15],
        ];

        foreach ($classes as $class) {
            ClassRoom::create([
                'name' => $class['name'],
                'level' => $class['level'],
                'capacity' => $class['capacity'],
                'description' => "Kelas {$class['level']} untuk anak usia dini",
            ]);
        }
    }

    /**
     * Buat kelas dengan wali kelas
     */
    private function createClassRoomsWithTeachers($teachers): void
    {
        $classes = [
            ['name' => 'Kelas A1', 'level' => 'TK A', 'capacity' => 20],
            ['name' => 'Kelas A2', 'level' => 'TK A', 'capacity' => 20],
            ['name' => 'Kelas B1', 'level' => 'TK B', 'capacity' => 25],
            ['name' => 'Kelas B2', 'level' => 'TK B', 'capacity' => 25],
            ['name' => 'Playgroup 1', 'level' => 'PG', 'capacity' => 15],
            ['name' => 'Playgroup 2', 'level' => 'PG', 'capacity' => 15],
        ];

        // Jika jumlah guru kurang dari jumlah kelas, gunakan guru berulang
        $teacherCount = $teachers->count();
        $classCount = count($classes);
        
        for ($i = 0; $i < $classCount; $i++) {
            $teacherIndex = $i % $teacherCount; // Gunakan modulo untuk berulang jika guru tidak cukup
            $teacher = $teachers[$teacherIndex];
            
            ClassRoom::create([
                'name' => $classes[$i]['name'],
                'level' => $classes[$i]['level'],
                'capacity' => $classes[$i]['capacity'],
                'description' => "Kelas {$classes[$i]['level']} untuk anak usia dini",
                'teacher_id' => $teacher->id,
            ]);
        }
    }
}