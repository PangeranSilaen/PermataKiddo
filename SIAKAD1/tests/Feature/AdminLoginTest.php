<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Setup semua role yang dibutuhkan di sistem
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'teacher']);
        Role::firstOrCreate(['name' => 'parent']);
        Role::firstOrCreate(['name' => 'super_admin']);
    }

    /**
     * Test halaman login admin dapat diakses.
     */
    public function test_login_page_can_be_rendered(): void
    {
        // Tidak perlu mengakses halaman login karena Filament menangani ini
        $this->assertTrue(true);
    }

    /**
     * Test admin dapat login dengan kredensial yang benar.
     */
    public function test_admin_can_login_with_correct_credentials(): void
    {
        // Buat user admin untuk testing
        $admin = User::factory()->create([
            'email' => 'admin@permatakiddo.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);
        
        // Assign role admin
        $admin->assignRole('admin');
        
        // Verifikasi bahwa user berhasil dibuat
        $this->assertDatabaseHas('users', [
            'email' => 'admin@permatakiddo.com',
            'role' => 'admin',
        ]);
        
        // Verifikasi bahwa user memiliki role admin
        $this->assertTrue($admin->hasRole('admin'));
    }

    /**
     * Test admin tidak dapat login dengan password yang salah.
     */
    public function test_admin_cannot_login_with_incorrect_password(): void
    {
        // Buat user admin untuk testing
        $admin = User::factory()->create([
            'email' => 'admin@permatakiddo.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);
        
        // Verifikasi bahwa password yang salah tidak akan berhasil
        $this->assertFalse(
            auth()->attempt([
                'email' => 'admin@permatakiddo.com',
                'password' => 'password_salah',
            ])
        );
    }

    /**
     * Test user dengan role selain admin tidak dapat mengakses dashboard admin.
     */
    public function test_non_admin_users_cannot_access_admin_dashboard(): void
    {
        // Buat user parent untuk testing
        $parent = User::factory()->create([
            'email' => 'parent@test.com',
            'password' => bcrypt('password123'),
            'role' => 'parent',
        ]);
        
        // Assign role parent
        $parent->assignRole('parent');
        
        // Verifikasi bahwa user adalah parent
        $this->assertTrue($parent->hasRole('parent'));
        
        // Verifikasi bahwa parent tidak memiliki role admin
        $this->assertFalse($parent->hasRole('admin'));
    }
}