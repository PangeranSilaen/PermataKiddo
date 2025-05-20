<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Registration;
use App\Models\User;
use Carbon\Carbon;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dapatkan beberapa user dengan role parent
        $parents = User::where('role', 'parent')->get();
        
        if ($parents->isEmpty()) {
            $this->command->info('Tidak ada user parent untuk membuat registrasi. Registration seeder dilewati.');
            return;
        }
        
        // Buat beberapa data registrasi dengan status berbeda
        $statuses = ['pending', 'accepted', 'rejected'];
        $levels = ['TK A', 'TK B', 'PG'];
        
        foreach ($parents as $parent) {
            // Buat 1-2 pendaftaran untuk setiap parent
            $numRegistrations = rand(1, 2);
            
            for ($i = 0; $i < $numRegistrations; $i++) {
                $status = $statuses[array_rand($statuses)];
                $level = $levels[array_rand($levels)];
                $registrationDate = Carbon::now()->subDays(rand(1, 60));
                
                Registration::create([
                    'user_id' => $parent->id,
                    'child_name' => $this->generateChildName(),
                    'birth_date' => Carbon::now()->subYears(rand(3, 6))->subMonths(rand(0, 11)),
                    'gender' => ['male', 'female'][rand(0, 1)],
                    'address' => $this->generateAddress(),
                    'parent_phone' => $this->generatePhone(),
                    'registration_date' => $registrationDate,
                    'status' => $status,
                    'level' => $level,
                    'previous_school' => rand(0, 1) ? $this->generatePreviousSchool() : null,
                    'notes' => rand(0, 1) ? $this->generateNotes() : null,
                ]);
            }
        }
    }
    
    /**
     * Generate random child name
     */
    private function generateChildName(): string
    {
        $firstNames = ['Aditya', 'Budi', 'Cinta', 'Dewi', 'Eko', 'Fitri', 'Gita', 'Hadi', 'Indah', 'Joko', 'Kartika', 'Lina', 'Mira', 'Nadia', 'Oki', 'Putri', 'Rendi', 'Siti', 'Tono', 'Umi'];
        $lastNames = ['Pratama', 'Wijaya', 'Sari', 'Kusuma', 'Nugraha', 'Dewi', 'Saputra', 'Hidayat', 'Permata', 'Santoso', 'Rahayu', 'Wati', 'Hartono', 'Susanto', 'Ramadhan'];
        
        return $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
    }
    
    /**
     * Generate random address
     */
    private function generateAddress(): string
    {
        $streets = ['Jl. Sudirman', 'Jl. Thamrin', 'Jl. Gatot Subroto', 'Jl. Ahmad Yani', 'Jl. Diponegoro', 'Jl. Pahlawan', 'Jl. Merdeka', 'Jl. Kebon Jeruk', 'Jl. Menteng', 'Jl. Cempaka'];
        $numbers = ['No. ' . rand(1, 100), 'No. ' . rand(1, 100) . 'A', 'No. ' . rand(1, 100) . '/B'];
        $cities = ['Jakarta', 'Bandung', 'Surabaya', 'Semarang', 'Yogyakarta', 'Malang', 'Denpasar', 'Medan', 'Palembang', 'Makassar'];
        
        return $streets[array_rand($streets)] . ' ' . $numbers[array_rand($numbers)] . ', ' . $cities[array_rand($cities)];
    }
    
    /**
     * Generate random phone number
     */
    private function generatePhone(): string
    {
        $prefixes = ['0812', '0813', '0857', '0878', '0822', '0821', '0856'];
        $suffix = '';
        
        for ($i = 0; $i < 8; $i++) {
            $suffix .= rand(0, 9);
        }
        
        return $prefixes[array_rand($prefixes)] . $suffix;
    }
    
    /**
     * Generate random previous school
     */
    private function generatePreviousSchool(): string
    {
        $schools = ['TK Ceria', 'TK Pelangi', 'Playgroup Bintang', 'TK Mutiara', 'Playgroup Cerdas', 'TK Harapan', 'Playgroup Pintar', 'TK Cendekia', 'Daycare Bunda'];
        
        return $schools[array_rand($schools)];
    }
    
    /**
     * Generate random notes
     */
    private function generateNotes(): string
    {
        $notes = [
            'Anak memiliki alergi makanan tertentu',
            'Perlu pendampingan khusus',
            'Sangat aktif dan komunikatif',
            'Pendiam tetapi cerdas',
            'Memiliki bakat di bidang seni',
            'Suka bermain dengan teman sebaya',
            'Orang tua berharap anak dapat lebih mandiri',
            'Anak memiliki minat di bidang musik',
            'Perlu perhatian khusus dalam kemampuan sosial',
            'Anak cepat beradaptasi dengan lingkungan baru'
        ];
        
        return $notes[array_rand($notes)];
    }
}