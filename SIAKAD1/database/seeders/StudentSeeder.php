<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan role parent sudah dibuat
        $parentRole = Role::firstOrCreate(['name' => 'parent']);
        
        // Ambil data kelas yang sudah ada
        $classRooms = ClassRoom::all();
        
        if ($classRooms->isEmpty()) {
            // Jika belum ada kelas, jalankan seeder kelas terlebih dahulu
            $this->call(ClassRoomSeeder::class);
            $classRooms = ClassRoom::all();
        }

        // Mapping kelas untuk memudahkan penugasan
        $classMapping = [];
        foreach ($classRooms as $classRoom) {
            $classMapping[$classRoom->name] = $classRoom->id;
        }

        // Daftar murid yang akan dibuat
        $students = [
            [
                'user' => [
                    'name' => 'Regina Apriany Sipahutar',
                    'email' => 'regina@gmail.com',
                    'password' => Hash::make('password123'),
                    'gender' => 'female',
                    'phone' => '081298765430',
                    'role' => 'parent',
                ],
                'student' => [
                    'name' => 'Pangeran Borneo Silaen',
                    'registration_number' => 'S-001',
                    'birth_date' => '2019-03-15',
                    'gender' => 'male',
                    'parent_name' => 'Regina Apriany Sipahutar',
                    'parent_phone' => '081298765430',
                    'address' => 'Jl. Gatot Subroto No. 18, Jakarta',
                    'join_date' => '2023-07-10',
                    'status' => 'active',
                    'class_name' => 'Kelas 1A' // Akan dikonversi ke class_room_id
                ]
            ],
            [
                'user' => [
                    'name' => 'Ahmad Fauzi',
                    'email' => 'ahmad.fauzi@parent.permatakiddo.com',
                    'password' => Hash::make('password123'),
                    'gender' => 'male',
                    'phone' => '081298765432',
                    'role' => 'parent',
                ],
                'student' => [
                    'name' => 'Farhan Fauzi',
                    'registration_number' => 'S-002',
                    'birth_date' => '2018-05-10',
                    'gender' => 'male',
                    'parent_name' => 'Ahmad Fauzi',
                    'parent_phone' => '081298765432',
                    'address' => 'Jl. Kebon Jeruk No. 25, Jakarta',
                    'join_date' => '2023-07-17',
                    'status' => 'active',
                    'class_name' => 'Kelas 1A' // Akan dikonversi ke class_room_id
                ]
            ],
            [
                'user' => [
                    'name' => 'Ratna Dewi',
                    'email' => 'ratna.dewi@parent.permatakiddo.com',
                    'password' => Hash::make('password123'),
                    'gender' => 'female',
                    'phone' => '081298765433',
                    'role' => 'parent',
                ],
                'student' => [
                    'name' => 'Amelia Ratna',
                    'registration_number' => 'S-003',
                    'birth_date' => '2018-08-15',
                    'gender' => 'female',
                    'parent_name' => 'Ratna Dewi',
                    'parent_phone' => '081298765433',
                    'address' => 'Jl. Pahlawan No. 10, Jakarta',
                    'join_date' => '2023-07-17',
                    'status' => 'active',
                    'class_name' => 'Kelas 1A' // Akan dikonversi ke class_room_id
                ]
            ],
            [
                'user' => [
                    'name' => 'Surya Adi',
                    'email' => 'surya.adi@parent.permatakiddo.com',
                    'password' => Hash::make('password123'),
                    'gender' => 'male',
                    'phone' => '081298765434',
                    'role' => 'parent',
                ],
                'student' => [
                    'name' => 'Bima Surya',
                    'registration_number' => 'S-004',
                    'birth_date' => '2018-04-20',
                    'gender' => 'male',
                    'parent_name' => 'Surya Adi',
                    'parent_phone' => '081298765434',
                    'address' => 'Jl. Cendrawasih No. 7, Jakarta',
                    'join_date' => '2023-07-18',
                    'status' => 'active',
                    'class_name' => 'Kelas 1B' // Akan dikonversi ke class_room_id
                ]
            ],
            [
                'user' => [
                    'name' => 'Lina Wijaya',
                    'email' => 'lina.wijaya@parent.permatakiddo.com',
                    'password' => Hash::make('password123'),
                    'gender' => 'female',
                    'phone' => '081298765435',
                    'role' => 'parent',
                ],
                'student' => [
                    'name' => 'Citra Wijaya',
                    'registration_number' => 'S-005',
                    'birth_date' => '2018-06-30',
                    'gender' => 'female',
                    'parent_name' => 'Lina Wijaya',
                    'parent_phone' => '081298765435',
                    'address' => 'Jl. Anggrek No. 15, Jakarta',
                    'join_date' => '2023-07-18',
                    'status' => 'active',
                    'class_name' => 'Kelas 1B' // Akan dikonversi ke class_room_id
                ]
            ],
            [
                'user' => [
                    'name' => 'Deni Prakoso',
                    'email' => 'deni.prakoso@parent.permatakiddo.com',
                    'password' => Hash::make('password123'),
                    'gender' => 'male',
                    'phone' => '081298765436',
                    'role' => 'parent',
                ],
                'student' => [
                    'name' => 'Dika Prakoso',
                    'registration_number' => 'S-006',
                    'birth_date' => '2017-03-25',
                    'gender' => 'male',
                    'parent_name' => 'Deni Prakoso',
                    'parent_phone' => '081298765436',
                    'address' => 'Jl. Mawar No. 9, Jakarta',
                    'join_date' => '2022-07-15',
                    'status' => 'active',
                    'class_name' => 'Kelas 2A' // Akan dikonversi ke class_room_id
                ]
            ],
            [
                'user' => [
                    'name' => 'Rina Sari',
                    'email' => 'rina.sari@parent.permatakiddo.com',
                    'password' => Hash::make('password123'),
                    'gender' => 'female',
                    'phone' => '081298765437',
                    'role' => 'parent',
                ],
                'student' => [
                    'name' => 'Erika Sari',
                    'registration_number' => 'S-007',
                    'birth_date' => '2017-07-12',
                    'gender' => 'female',
                    'parent_name' => 'Rina Sari',
                    'parent_phone' => '081298765437',
                    'address' => 'Jl. Melati No. 22, Jakarta',
                    'join_date' => '2022-07-16',
                    'status' => 'active',
                    'class_name' => 'Kelas 2A' // Akan dikonversi ke class_room_id
                ]
            ],
            [
                'user' => [
                    'name' => 'Joko Susilo',
                    'email' => 'joko.susilo@parent.permatakiddo.com',
                    'password' => Hash::make('password123'),
                    'gender' => 'male',
                    'phone' => '081298765438',
                    'role' => 'parent',
                ],
                'student' => [
                    'name' => 'Fajar Susilo',
                    'registration_number' => 'S-008',
                    'birth_date' => '2017-09-05',
                    'gender' => 'male',
                    'parent_name' => 'Joko Susilo',
                    'parent_phone' => '081298765438',
                    'address' => 'Jl. Kamboja No. 33, Jakarta',
                    'join_date' => '2022-07-16',
                    'status' => 'active',
                    'class_name' => 'Kelas 2B' // Akan dikonversi ke class_room_id
                ]
            ],
            [
                'user' => [
                    'name' => 'Nina Hartati',
                    'email' => 'nina.hartati@parent.permatakiddo.com',
                    'password' => Hash::make('password123'),
                    'gender' => 'female',
                    'phone' => '081298765439',
                    'role' => 'parent',
                ],
                'student' => [
                    'name' => 'Gita Hartati',
                    'registration_number' => 'S-009',
                    'birth_date' => '2017-11-18',
                    'gender' => 'female',
                    'parent_name' => 'Nina Hartati',
                    'parent_phone' => '081298765439',
                    'address' => 'Jl. Dahlia No. 18, Jakarta',
                    'join_date' => '2022-07-17',
                    'status' => 'active',
                    'class_name' => 'Kelas 2B' // Akan dikonversi ke class_room_id
                ]
            ],
            [
                'user' => [
                    'name' => 'Agung Nugroho',
                    'email' => 'agung.nugroho@parent.permatakiddo.com',
                    'password' => Hash::make('password123'),
                    'gender' => 'male',
                    'phone' => '081298765440',
                    'role' => 'parent',
                ],
                'student' => [
                    'name' => 'Hadi Nugroho',
                    'registration_number' => 'S-010',
                    'birth_date' => '2016-02-15',
                    'gender' => 'male',
                    'parent_name' => 'Agung Nugroho',
                    'parent_phone' => '081298765440',
                    'address' => 'Jl. Kenanga No. 27, Jakarta',
                    'join_date' => '2021-07-15',
                    'status' => 'active',
                    'class_name' => 'Kelas 3A' // Akan dikonversi ke class_room_id
                ]
            ]
        ];

        // Buat user dan data murid
        foreach ($students as $studentData) {
            // Cek apakah user sudah ada
            $existingUser = User::where('email', $studentData['user']['email'])->first();
            
            if (!$existingUser) {
                // Buat user baru (orang tua)
                $user = User::create($studentData['user']);
                $user->assignRole('parent');
                
                // Konversi nama kelas ke class_room_id
                $className = $studentData['student']['class_name'];
                $classRoomId = $classMapping[$className] ?? null;
                
                if ($classRoomId) {
                    // Buat data murid
                    $studentData['student']['user_id'] = $user->id;
                    $studentData['student']['class_room_id'] = $classRoomId;
                    
                    // Hapus class_name karena sudah dikonversi ke class_room_id
                    unset($studentData['student']['class_name']);
                    
                    Student::create($studentData['student']);
                }
            }
        }
    }
}