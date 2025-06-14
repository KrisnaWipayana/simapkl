<?php

namespace App\Filament\Resources\DospemResource\Pages;

use App\Filament\Resources\DospemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDospem extends EditRecord
{
    protected static string $resource = DospemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
