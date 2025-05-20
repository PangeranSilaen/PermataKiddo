<?php

namespace App\Filament\Resources\RegistrationResource\Pages;

use App\Filament\Resources\RegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegistrations extends ListRecords
{
    protected static string $resource = RegistrationResource::class;

    public function getTitle(): string
    {
        return 'Daftar Pendaftaran Online';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Pendaftaran Baru'),
        ];
    }
}
