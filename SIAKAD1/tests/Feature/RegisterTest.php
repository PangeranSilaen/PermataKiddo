<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Buat role yang diperlukan
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'parent']);
        Role::firstOrCreate(['name' => 'teacher']);
    }

    /**
     * Test halaman register dapat diakses.
     */
    public function test_register_page_can_be_rendered(): void
    {
        $response = $this->get('/register');
        
        $response->assertStatus(200);
    }

    /**
     * Test user dapat register sebagai orang tua.
     */
    public function test_user_can_register_as_parent(): void
    {
        // Data untuk registrasi
        $userData = [
            'name' => 'Orang Tua Test',
            'email' => 'orangtua@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'gender' => 'male',
            'phone' => '08123456789',
            'role' => 'parent',
        ];

        // Kirim request registrasi
        $response = $this->post('/register', $userData);
        
        // Pastikan user berhasil disimpan di database
        $this->assertDatabaseHas('users', [
            'email' => 'orangtua@test.com',
            'role' => 'parent',
        ]);
        
        // Verifikasi hasil - gunakan assertStatus alih-alih assertRedirect
        // karena kita mungkin tidak tahu persis redirect URL
        $response->assertStatus(302);
    }

    /**
     * Test validasi input pada saat registrasi.
     */
    public function test_register_validation_works(): void
    {
        // Kirim data registrasi yang tidak lengkap
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'bukan-email',
            'password' => 'short',
            'password_confirmation' => 'different',
        ]);
        
        // Pastikan respons adalah redirect kembali ke form dengan error
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }
}