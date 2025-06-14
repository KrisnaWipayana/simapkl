<?php

namespace App\Filament\Resources\DospemResource\Pages;

use App\Filament\Resources\DospemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDospems extends ListRecords
{
    protected static string $resource = DospemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
