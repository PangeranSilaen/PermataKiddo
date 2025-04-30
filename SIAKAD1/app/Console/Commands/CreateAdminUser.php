<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin-user {email=admin@example.com} {password=password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user to restore admin access';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Make sure the admin role exists
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        
        // Create admin user
        $email = $this->argument('email');
        $password = $this->argument('password');
        
        // Check if the user already exists
        $user = User::where('email', $email)->first();
        
        if ($user) {
            $this->info("Admin user with email {$email} already exists.");
            $this->info("Reassigning admin role to this user...");
            $user->assignRole('admin');
            $user->update(['role' => 'admin']);
        } else {
            // Create new admin user
            $user = User::create([
                'name' => 'Administrator',
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'admin',
            ]);
            
            // Assign admin role
            $user->assignRole('admin');
            
            $this->info("Admin user created successfully with:");
            $this->info("Email: {$email}");
            $this->info("Password: {$password}");
        }
        
        $this->info("You can now login at /admin");
    }
}
