<?php

namespace App\Filament\Resources\InstansiLainResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\InstansiLainResource;

class EditInstansiLain extends EditRecord
{
    protected static string $resource = InstansiLainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
