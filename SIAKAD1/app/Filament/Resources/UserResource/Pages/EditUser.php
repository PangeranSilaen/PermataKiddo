<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Teacher;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Jika role adalah teacher, muat data teacher
        if ($data['role'] === 'teacher') {
            // Cari data teacher berdasarkan user_id
            $teacher = Teacher::where('user_id', $data['id'])->first();
            
            if ($teacher) {
                $data['teacher'] = [
                    'nip' => $teacher->employee_id ?? 'T-' . rand(10000, 99999),
                    'subject' => $teacher->specialization ?? 'General',
                    'address' => $teacher->address ?? 'Alamat belum diisi',
                ];
            } else {
                // Default jika belum ada data teacher
                $data['teacher'] = [
                    'nip' => 'T-' . rand(10000, 99999),
                    'subject' => 'General',
                    'address' => 'Alamat belum diisi',
                ];
            }
        }
        
        return $data;
    }
    
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Update user data
        $record->update($data);
        
        // Update role if changed
        if ($record->getRoleNames()->first() !== $data['role']) {
            $record->syncRoles([$data['role']]);
        }
        
        // Update or create teacher profile if role is teacher
        if ($data['role'] === 'teacher') {
            if (isset($data['teacher'])) {
                // Pastikan nilai default jika kosong
                $nip = !empty($data['teacher']['nip']) ? $data['teacher']['nip'] : 'T-' . rand(10000, 99999);
                $subject = !empty($data['teacher']['subject']) ? $data['teacher']['subject'] : 'General';
                $address = !empty($data['teacher']['address']) ? $data['teacher']['address'] : 'Alamat belum diisi';
                
                // Cari teacher berdasarkan user_id jika sudah ada
                $teacher = Teacher::where('user_id', $record->id)->first();
                
                if ($teacher) {
                    // Update data yang sudah ada
                    $teacher->update([
                        'name' => $record->name,
                        'employee_id' => $nip,
                        'specialization' => $subject,
                        'address' => $address,
                    ]);
                } else {
                    // Buat data teacher baru
                    Teacher::create([
                        'user_id' => $record->id,
                        'name' => $record->name,
                        'employee_id' => $nip,
                        'specialization' => $subject,
                        'address' => $address,
                        'phone_number' => $record->phone ?? '0000000000',
                        'join_date' => now()->toDateString(),
                        'status' => 'active',
                    ]);
                }
            }
        } else {
            // If user is no longer a teacher, delete teacher profile
            Teacher::where('user_id', $record->id)->delete();
        }
        
        return $record;
    }
}
