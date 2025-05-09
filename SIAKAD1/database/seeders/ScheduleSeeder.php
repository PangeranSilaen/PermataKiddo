<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mendapatkan data guru
        $teacher1 = Teacher::where('employee_id', 'EMP001')->first();
        $teacher2 = Teacher::where('employee_id', 'EMP002')->first();
        $teacher3 = Teacher::where('employee_id', 'EMP003')->first();

        // Membuat jadwal untuk guru 1
        Schedule::create([
            'teacher_id' => $teacher1->id,
            'subject_name' => 'Matematika Dasar',
            'day_of_week' => 'Monday',
            'start_time' => '08:00:00',
            'end_time' => '09:30:00',
            'room' => 'Kelas A',
            'class_group' => 'TK A',
            'notes' => 'Pengenalan angka dan konsep berhitung dasar',
            'status' => 'active',
        ]);

        // Membuat jadwal untuk guru 2
        Schedule::create([
            'teacher_id' => $teacher2->id,
            'subject_name' => 'Seni dan Kerajinan',
            'day_of_week' => 'Tuesday',
            'start_time' => '10:00:00',
            'end_time' => '11:30:00',
            'room' => 'Kelas B',
            'class_group' => 'TK B',
            'notes' => 'Melukis dan membuat kerajinan tangan sederhana',
            'status' => 'active',
        ]);

        // Membuat jadwal untuk guru 3
        Schedule::create([
            'teacher_id' => $teacher3->id,
            'subject_name' => 'Pengenalan Bahasa',
            'day_of_week' => 'Wednesday',
            'start_time' => '09:00:00',
            'end_time' => '10:30:00',
            'room' => 'Kelas C',
            'class_group' => 'TK A',
            'notes' => 'Belajar membaca dan menulis huruf',
            'status' => 'active',
        ]);
    }
}
