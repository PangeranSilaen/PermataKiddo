<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Teacher;
use App\Models\ClassRoom;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data guru dan kelas yang sudah ada
        $teachers = Teacher::all();
        $classRooms = ClassRoom::all();
        
        if ($teachers->isEmpty() || $classRooms->isEmpty()) {
            // Jika data guru atau kelas belum ada, jalankan seeder terlebih dahulu
            $this->call([
                TeacherSeeder::class,
                ClassRoomSeeder::class,
            ]);
            
            $teachers = Teacher::all();
            $classRooms = ClassRoom::all();
        }

        // Mapping guru berdasarkan spesialisasi
        $teacherBySpecialization = [];
        foreach ($teachers as $teacher) {
            $teacherBySpecialization[$teacher->specialization] = $teacher->id;
        }

        // Daftar jadwal yang akan dibuat
        $schedules = [
            // Jadwal untuk Kelas 1A
            [
                'teacher_specialization' => 'Matematika',
                'subject_name' => 'Matematika Dasar',
                'class_name' => 'Kelas 1A',
                'day_of_week' => 'Monday',
                'start_time' => '08:00',
                'end_time' => '09:30',
                'room' => 'Ruang 101',
                'status' => 'active',
                'notes' => 'Pengenalan angka dan konsep dasar matematika.',
            ],
            [
                'teacher_specialization' => 'Bahasa Indonesia',
                'subject_name' => 'Bahasa Indonesia',
                'class_name' => 'Kelas 1A',
                'day_of_week' => 'Monday',
                'start_time' => '10:00',
                'end_time' => '11:30',
                'room' => 'Ruang 101',
                'status' => 'active',
                'notes' => 'Pengenalan membaca dan menulis.',
            ],
            [
                'teacher_specialization' => 'Ilmu Pengetahuan Alam',
                'subject_name' => 'IPA Dasar',
                'class_name' => 'Kelas 1A',
                'day_of_week' => 'Tuesday',
                'start_time' => '08:00',
                'end_time' => '09:30',
                'room' => 'Ruang 101',
                'status' => 'active',
                'notes' => 'Pengenalan alam sekitar.',
            ],
            [
                'teacher_specialization' => 'Bahasa Inggris',
                'subject_name' => 'Bahasa Inggris Dasar',
                'class_name' => 'Kelas 1A',
                'day_of_week' => 'Tuesday',
                'start_time' => '10:00',
                'end_time' => '11:30',
                'room' => 'Ruang 101',
                'status' => 'active',
                'notes' => 'Pengenalan kosakata dasar bahasa Inggris.',
            ],
            [
                'teacher_specialization' => 'Pendidikan Jasmani',
                'subject_name' => 'Olahraga',
                'class_name' => 'Kelas 1A',
                'day_of_week' => 'Wednesday',
                'start_time' => '08:00',
                'end_time' => '09:30',
                'room' => 'Lapangan',
                'status' => 'active',
                'notes' => 'Aktivitas fisik dan permainan kelompok.',
            ],

            // Jadwal untuk Kelas 1B
            [
                'teacher_specialization' => 'Matematika',
                'subject_name' => 'Matematika Dasar',
                'class_name' => 'Kelas 1B',
                'day_of_week' => 'Monday',
                'start_time' => '08:00',
                'end_time' => '09:30',
                'room' => 'Ruang 102',
                'status' => 'active',
                'notes' => 'Pengenalan angka dan konsep dasar matematika.',
            ],
            [
                'teacher_specialization' => 'Bahasa Indonesia',
                'subject_name' => 'Bahasa Indonesia',
                'class_name' => 'Kelas 1B',
                'day_of_week' => 'Monday',
                'start_time' => '10:00',
                'end_time' => '11:30',
                'room' => 'Ruang 102',
                'status' => 'active',
                'notes' => 'Pengenalan membaca dan menulis.',
            ],
            [
                'teacher_specialization' => 'Ilmu Pengetahuan Alam',
                'subject_name' => 'IPA Dasar',
                'class_name' => 'Kelas 1B',
                'day_of_week' => 'Tuesday',
                'start_time' => '08:00',
                'end_time' => '09:30',
                'room' => 'Ruang 102',
                'status' => 'active',
                'notes' => 'Pengenalan alam sekitar.',
            ],
            [
                'teacher_specialization' => 'Bahasa Inggris',
                'subject_name' => 'Bahasa Inggris Dasar',
                'class_name' => 'Kelas 1B',
                'day_of_week' => 'Tuesday',
                'start_time' => '10:00',
                'end_time' => '11:30',
                'room' => 'Ruang 102',
                'status' => 'active',
                'notes' => 'Pengenalan kosakata dasar bahasa Inggris.',
            ],
            [
                'teacher_specialization' => 'Pendidikan Jasmani',
                'subject_name' => 'Olahraga',
                'class_name' => 'Kelas 1B',
                'day_of_week' => 'Wednesday',
                'start_time' => '08:00',
                'end_time' => '09:30',
                'room' => 'Lapangan',
                'status' => 'active',
                'notes' => 'Aktivitas fisik dan permainan kelompok.',
            ],

            // Jadwal untuk Kelas 2A
            [
                'teacher_specialization' => 'Matematika',
                'subject_name' => 'Matematika Lanjutan',
                'class_name' => 'Kelas 2A',
                'day_of_week' => 'Wednesday',
                'start_time' => '10:00',
                'end_time' => '11:30',
                'room' => 'Ruang 201',
                'status' => 'active',
                'notes' => 'Operasi hitung dasar dan pemecahan masalah sederhana.',
            ],
            [
                'teacher_specialization' => 'Bahasa Indonesia',
                'subject_name' => 'Bahasa Indonesia Lanjutan',
                'class_name' => 'Kelas 2A',
                'day_of_week' => 'Thursday',
                'start_time' => '08:00',
                'end_time' => '09:30',
                'room' => 'Ruang 201',
                'status' => 'active',
                'notes' => 'Membaca pemahaman dan menulis cerita pendek.',
            ],
            [
                'teacher_specialization' => 'Ilmu Pengetahuan Alam',
                'subject_name' => 'IPA Lanjutan',
                'class_name' => 'Kelas 2A',
                'day_of_week' => 'Thursday',
                'start_time' => '10:00',
                'end_time' => '11:30',
                'room' => 'Ruang 201',
                'status' => 'active',
                'notes' => 'Pengenalan tumbuhan dan hewan.',
            ],
            [
                'teacher_specialization' => 'Bahasa Inggris',
                'subject_name' => 'Bahasa Inggris Lanjutan',
                'class_name' => 'Kelas 2A',
                'day_of_week' => 'Friday',
                'start_time' => '08:00',
                'end_time' => '09:30',
                'room' => 'Ruang 201',
                'status' => 'active',
                'notes' => 'Kalimat sederhana dan percakapan dasar.',
            ],
            [
                'teacher_specialization' => 'Pendidikan Jasmani',
                'subject_name' => 'Olahraga',
                'class_name' => 'Kelas 2A',
                'day_of_week' => 'Friday',
                'start_time' => '10:00',
                'end_time' => '11:30',
                'room' => 'Lapangan',
                'status' => 'active',
                'notes' => 'Aktivitas fisik dan permainan tim.',
            ],

            // Jadwal untuk Kelas 2B
            [
                'teacher_specialization' => 'Matematika',
                'subject_name' => 'Matematika Lanjutan',
                'class_name' => 'Kelas 2B',
                'day_of_week' => 'Wednesday',
                'start_time' => '10:00',
                'end_time' => '11:30',
                'room' => 'Ruang 202',
                'status' => 'active',
                'notes' => 'Operasi hitung dasar dan pemecahan masalah sederhana.',
            ],
            [
                'teacher_specialization' => 'Bahasa Indonesia',
                'subject_name' => 'Bahasa Indonesia Lanjutan',
                'class_name' => 'Kelas 2B',
                'day_of_week' => 'Thursday',
                'start_time' => '08:00',
                'end_time' => '09:30',
                'room' => 'Ruang 202',
                'status' => 'active',
                'notes' => 'Membaca pemahaman dan menulis cerita pendek.',
            ],
            [
                'teacher_specialization' => 'Ilmu Pengetahuan Alam',
                'subject_name' => 'IPA Lanjutan',
                'class_name' => 'Kelas 2B',
                'day_of_week' => 'Thursday',
                'start_time' => '10:00',
                'end_time' => '11:30',
                'room' => 'Ruang 202',
                'status' => 'active',
                'notes' => 'Pengenalan tumbuhan dan hewan.',
            ],
            [
                'teacher_specialization' => 'Bahasa Inggris',
                'subject_name' => 'Bahasa Inggris Lanjutan',
                'class_name' => 'Kelas 2B',
                'day_of_week' => 'Friday',
                'start_time' => '08:00',
                'end_time' => '09:30',
                'room' => 'Ruang 202',
                'status' => 'active',
                'notes' => 'Kalimat sederhana dan percakapan dasar.',
            ],
            [
                'teacher_specialization' => 'Pendidikan Jasmani',
                'subject_name' => 'Olahraga',
                'class_name' => 'Kelas 2B',
                'day_of_week' => 'Friday',
                'start_time' => '10:00',
                'end_time' => '11:30',
                'room' => 'Lapangan',
                'status' => 'active',
                'notes' => 'Aktivitas fisik dan permainan tim.',
            ],

            // Jadwal untuk Kelas 3A
            [
                'teacher_specialization' => 'Matematika',
                'subject_name' => 'Matematika Tingkat Menengah',
                'class_name' => 'Kelas 3A',
                'day_of_week' => 'Monday',
                'start_time' => '13:00',
                'end_time' => '14:30',
                'room' => 'Ruang 301',
                'status' => 'active',
                'notes' => 'Perkalian, pembagian, dan pengukuran dasar.',
            ],
            [
                'teacher_specialization' => 'Bahasa Indonesia',
                'subject_name' => 'Bahasa Indonesia Tingkat Menengah',
                'class_name' => 'Kelas 3A',
                'day_of_week' => 'Monday',
                'start_time' => '14:45',
                'end_time' => '16:15',
                'room' => 'Ruang 301',
                'status' => 'active',
                'notes' => 'Membaca pemahaman dan menulis paragraf.',
            ],
            [
                'teacher_specialization' => 'Ilmu Pengetahuan Alam',
                'subject_name' => 'IPA Tingkat Menengah',
                'class_name' => 'Kelas 3A',
                'day_of_week' => 'Tuesday',
                'start_time' => '13:00',
                'end_time' => '14:30',
                'room' => 'Ruang 301',
                'status' => 'active',
                'notes' => 'Lingkungan hidup dan fenomena alam.',
            ],
            [
                'teacher_specialization' => 'Bahasa Inggris',
                'subject_name' => 'Bahasa Inggris Tingkat Menengah',
                'class_name' => 'Kelas 3A',
                'day_of_week' => 'Tuesday',
                'start_time' => '14:45',
                'end_time' => '16:15',
                'room' => 'Ruang 301',
                'status' => 'active',
                'notes' => 'Membaca teks pendek dan menulis kalimat sederhana.',
            ],
            [
                'teacher_specialization' => 'Pendidikan Jasmani',
                'subject_name' => 'Olahraga',
                'class_name' => 'Kelas 3A',
                'day_of_week' => 'Wednesday',
                'start_time' => '13:00',
                'end_time' => '14:30',
                'room' => 'Lapangan',
                'status' => 'active',
                'notes' => 'Permainan bola dan aktivitas fisik terstruktur.',
            ],
        ];

        // Buat jadwal
        foreach ($schedules as $scheduleData) {
            // Ambil ID guru berdasarkan spesialisasi
            $teacherId = $teacherBySpecialization[$scheduleData['teacher_specialization']] ?? null;
            
            // Ambil ID kelas berdasarkan nama kelas
            $classRoom = $classRooms->firstWhere('name', $scheduleData['class_name']);
            $classGroupId = $classRoom ? $classRoom->id : null;
            
            if ($teacherId && $classGroupId) {
                // Hapus field yang tidak ada di model
                unset($scheduleData['teacher_specialization']);
                unset($scheduleData['class_name']);
                
                // Tambahkan ID guru dan ID kelas
                $scheduleData['teacher_id'] = $teacherId;
                $scheduleData['class_group'] = $classGroupId;
                
                // Cek apakah jadwal ini sudah ada
                $existingSchedule = Schedule::where('teacher_id', $teacherId)
                                          ->where('day_of_week', $scheduleData['day_of_week'])
                                          ->where('start_time', $scheduleData['start_time'])
                                          ->first();
                
                if (!$existingSchedule) {
                    Schedule::create($scheduleData);
                }
            }
        }
    }
}