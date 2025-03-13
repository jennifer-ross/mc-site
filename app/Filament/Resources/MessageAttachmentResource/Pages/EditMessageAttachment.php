<?php

namespace App\Filament\Resources\MessageAttachmentResource\Pages;

use App\Filament\Resources\MessageAttachmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMessageAttachment extends EditRecord
{
    protected static string $resource = MessageAttachmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
