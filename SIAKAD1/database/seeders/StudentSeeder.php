<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mendapatkan user dengan peran parent
        $parentUser1 = User::where('email', 'ahmad.parent@permatakiddo.com')->first();
        $parentUser2 = User::where('email', 'dewi.parent@permatakiddo.com')->first();
        $parentUser3 = User::where('email', 'rudi.parent@permatakiddo.com')->first();

        // Membuat data siswa terkait dengan parent
        Student::create([
            'user_id' => $parentUser1->id,
            'nama_anak' => 'Zahra Husein',
            'tanggal_lahir' => '2019-05-10',
            'tempat_lahir' => 'Jakarta',
            'nik' => '3101234567890001',
            'jenis_kelamin' => 'female',
            'agama' => 'Islam',
            'nama_ayah' => 'Ahmad Husein',
            'nama_ibu' => 'Nurul Husein',
            'pekerjaan_ayah' => 'Wiraswasta',
            'pekerjaan_ibu' => 'Ibu Rumah Tangga',
            'alamat' => 'Jl. Mawar No. 15, Jakarta Selatan',
        ]);

        Student::create([
            'user_id' => $parentUser2->id,
            'nama_anak' => 'Bima Susanto',
            'tanggal_lahir' => '2018-08-22',
            'tempat_lahir' => 'Jakarta',
            'nik' => '3101234567890002',
            'jenis_kelamin' => 'male',
            'agama' => 'Kristen',
            'nama_ayah' => 'Susanto',
            'nama_ibu' => 'Dewi Susanti',
            'pekerjaan_ayah' => 'Pegawai Swasta',
            'pekerjaan_ibu' => 'Pegawai Swasta',
            'alamat' => 'Jl. Melati No. 7, Jakarta Barat',
        ]);

        Student::create([
            'user_id' => $parentUser3->id,
            'nama_anak' => 'Citra Hermawan',
            'tanggal_lahir' => '2019-11-15',
            'tempat_lahir' => 'Bandung',
            'nik' => '3101234567890003',
            'jenis_kelamin' => 'female',
            'agama' => 'Islam',
            'nama_ayah' => 'Rudi Hermawan',
            'nama_ibu' => 'Sinta Hermawan',
            'pekerjaan_ayah' => 'Dosen',
            'pekerjaan_ibu' => 'Dokter',
            'alamat' => 'Jl. Anggrek No. 23, Jakarta Timur',
        ]);
    }
}
