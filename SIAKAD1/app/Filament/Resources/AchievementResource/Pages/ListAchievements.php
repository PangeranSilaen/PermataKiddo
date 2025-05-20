<?php

namespace App\Filament\Resources\AchievementResource\Pages;

use App\Filament\Resources\AchievementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAchievements extends ListRecords
{
    protected static string $resource = AchievementResource::class;

    public function getTitle(): string
    {
        return 'Daftar Laporan Capaian';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Laporan Capaian Baru'),
        ];
    }
}
