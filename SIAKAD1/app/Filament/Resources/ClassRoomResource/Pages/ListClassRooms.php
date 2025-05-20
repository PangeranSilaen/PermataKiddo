<?php

namespace App\Filament\Resources\ClassRoomResource\Pages;

use App\Filament\Resources\ClassRoomResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassRooms extends ListRecords
{
    protected static string $resource = ClassRoomResource::class;

    public function getTitle(): string
    {
        return 'Daftar Kelas';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Kelas Baru'),
        ];
    }
}
