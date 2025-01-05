<?php

namespace App\Filament\Resources\NegaraResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\NegaraResource;

class EditNegara extends EditRecord
{
    protected static string $resource = NegaraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
