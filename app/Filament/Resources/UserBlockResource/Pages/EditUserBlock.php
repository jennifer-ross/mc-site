<?php

namespace App\Filament\Resources\UserBlockResource\Pages;

use App\Filament\Resources\UserBlockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserBlock extends EditRecord
{
    protected static string $resource = UserBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
