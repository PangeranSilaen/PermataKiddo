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
                Teacher::updateOrCreate(
                    ['user_id' => $record->id],
                    [
                        'nip' => $data['teacher']['nip'] ?? null,
                        'subject' => $data['teacher']['subject'] ?? null,
                        'address' => $data['teacher']['address'] ?? null,
                    ]
                );
            }
        } else {
            // If user is no longer a teacher, delete teacher profile
            Teacher::where('user_id', $record->id)->delete();
        }
        
        return $record;
    }
}
