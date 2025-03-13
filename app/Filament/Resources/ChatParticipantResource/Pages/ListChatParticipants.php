<?php

namespace App\Filament\Resources\ChatParticipantResource\Pages;

use App\Filament\Resources\ChatParticipantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChatParticipants extends ListRecords
{
    protected static string $resource = ChatParticipantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
