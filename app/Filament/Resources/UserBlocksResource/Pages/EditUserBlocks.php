<?php

namespace App\Filament\Resources\UserBlocksResource\Pages;

use App\Filament\Resources\UserBlocksResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserBlocks extends EditRecord
{
    protected static string $resource = UserBlocksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
