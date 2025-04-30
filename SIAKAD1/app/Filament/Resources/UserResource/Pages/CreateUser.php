<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Teacher;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    
    protected function handleRecordCreation(array $data): Model
    {
        $user = static::getModel()::create($data);
        
        // Assign role based on the selected role
        $user->assignRole($data['role']);
        
        // Create teacher profile if role is teacher
        if ($data['role'] === 'teacher' && isset($data['teacher'])) {
            Teacher::create([
                'user_id' => $user->id,
                'name' => $data['name'] ?? $user->name, // Use user's name if teacher name not provided
                'employee_id' => $data['teacher']['nip'] ?? 'T-' . str_pad($user->id, 5, '0', STR_PAD_LEFT), // Use NIP or generate one
                'specialization' => $data['teacher']['subject'] ?? null,
                'phone_number' => $data['teacher']['phone_number'] ?? $user->phone ?? '0000000000', // Use provided phone or default
                'address' => $data['teacher']['address'] ?? null,
                'join_date' => now()->toDateString(), // Set join date to current date
                'status' => 'active', // Default status
            ]);
        }
        
        return $user;
    }
}
