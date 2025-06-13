<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan role teacher sudah dibuat
        $teacherRole = Role::firstOrCreate(['name' => 'teacher']);

        // Daftar guru yang akan dibuat
        $teachers = [
            [
                'user' => [
                    'name' => 'Budi Santoso',
                    'email' => 'budi.santoso@permatakiddo.com',
                    'password' => Hash::make('password123'),
                    'gender' => 'male',
                    'phone' => '081234567890',
                    'role' => 'teacher',
                ],
                'teacher' => [
                    'name' => 'Budi Santoso',
                    'employee_id' => 'T-001',
                    'specialization' => 'Calistung',
                    'phone_number' => '081234567890',
                    'address' => 'Jl. Pendidikan No. 123, Jakarta',
                    'join_date' => '2020-07-15',
                    'status' => 'active',
                    'bio' => 'Guru Calistung dengan pengalaman 10 tahun mengajar di tingkat TK. Lulusan S1 Pendidikan Anak Usia Dini.',
                ]
            ],
            [
                'user' => [
                    'name' => 'Siti Nurhaliza',
                    'email' => 'siti.nurhaliza@permatakiddo.com',
                    'password' => Hash::make('password123'),
                    'gender' => 'female',
                    'phone' => '081234567891',
                    'role' => 'teacher',
                ],
                'teacher' => [
                    'name' => 'Siti Nurhaliza',
                    'employee_id' => 'T-002',
                    'specialization' => 'Seni Budaya',
                    'phone_number' => '081234567891',
                    'address' => 'Jl. Merdeka No. 45, Jakarta',
                    'join_date' => '2019-08-10',
                    'status' => 'active',
                    'bio' => 'Guru Seni Budaya dengan pengalaman 8 tahun mengajar. Lulusan S1 Pendidikan Seni dari Universitas Gadjah Mada.',
                ]
            ],
            [
                'user' => [
                    'name' => 'Ahmad Rizki',
                    'email' => 'ahmad.rizki@permatakiddo.com',
                    'password' => Hash::make('password123'),
                    'gender' => 'male',
                    'phone' => '081234567892',
                    'role' => 'teacher',
                ],
                'teacher' => [
                    'name' => 'Ahmad Rizki',
                    'employee_id' => 'T-003',
                    'specialization' => 'Agama',
                    'phone_number' => '081234567892',
                    'address' => 'Jl. Kebayoran No. 78, Jakarta',
                    'join_date' => '2021-01-05',
                    'status' => 'active',
                    'bio' => 'Guru Agama dengan pengalaman 5 tahun mengajar. Lulusan S1 Pendidikan Agama dari Universitas Islam Negeri.',
                ]
            ],
            [
                'user' => [
                    'name' => 'Dewi Kartika',
                    'email' => 'dewi.kartika@permatakiddo.com',
                    'password' => Hash::make('password123'),
                    'gender' => 'female',
                    'phone' => '081234567893',
                    'role' => 'teacher',
                ],
                'teacher' => [
                    'name' => 'Dewi Kartika',
                    'employee_id' => 'T-004',
                    'specialization' => 'Calistung',
                    'phone_number' => '081234567893',
                    'address' => 'Jl. Sudirman No. 100, Jakarta',
                    'join_date' => '2018-07-20',
                    'status' => 'active',
                    'bio' => 'Guru Calistung dengan pengalaman 12 tahun mengajar. Lulusan S2 Pendidikan Anak Usia Dini dari Universitas Negeri Jakarta.',
                ]
            ],
            [
                'user' => [
                    'name' => 'Rudi Hermawan',
                    'email' => 'rudi.hermawan@permatakiddo.com',
                    'password' => Hash::make('password123'),
                    'gender' => 'male',
                    'phone' => '081234567894',
                    'role' => 'teacher',
                ],
                'teacher' => [
                    'name' => 'Rudi Hermawan',
                    'employee_id' => 'T-005',
                    'specialization' => 'Seni Budaya',
                    'phone_number' => '081234567894',
                    'address' => 'Jl. Kemanggisan No. 55, Jakarta',
                    'join_date' => '2019-03-15',
                    'status' => 'active',
                    'bio' => 'Guru Seni Budaya dengan fokus pada keterampilan motorik anak. Lulusan S1 Pendidikan Seni dari Universitas Negeri Jakarta.',
                ]
            ],
        ];

        // Buat user dan data guru
        foreach ($teachers as $teacherData) {
            // Cek apakah user sudah ada
            $existingUser = User::where('email', $teacherData['user']['email'])->first();
            
            if (!$existingUser) {
                // Buat user baru
                $user = User::create($teacherData['user']);
                $user->assignRole('teacher');
                
                // Buat data guru
                $teacherData['teacher']['user_id'] = $user->id;
                Teacher::create($teacherData['teacher']);
            }
        }
    }
}
