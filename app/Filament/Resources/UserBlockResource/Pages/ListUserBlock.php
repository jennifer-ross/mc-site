<?php

namespace App\Filament\Resources\UserBlockResource\Pages;

use App\Filament\Resources\UserBlockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserBlock extends ListRecords
{
    protected static string $resource = UserBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
