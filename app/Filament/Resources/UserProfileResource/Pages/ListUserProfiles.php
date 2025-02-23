<?php

namespace App\Filament\Resources\UserProfilesResource\Pages;

use App\Filament\Resources\UserProfilesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserProfiles extends ListRecords
{
    /**
     * The resource model.
     */
    protected static string $resource = UserProfilesResource::class;

    /**
     * The header actions.
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
