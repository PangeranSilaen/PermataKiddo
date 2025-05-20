<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTeachers extends ListRecords
{
    protected static string $resource = TeacherResource::class;

    public function getTitle(): string
    {
        return 'Daftar Guru';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Guru Baru'),
        ];
    }
}
