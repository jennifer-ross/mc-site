<?php

namespace App\Filament\Resources\MessageAttachmentResource\Pages;

use App\Filament\Resources\MessageAttachmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMessageAttachments extends ListRecords
{
    protected static string $resource = MessageAttachmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
