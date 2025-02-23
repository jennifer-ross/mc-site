<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserBlocksResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\UserProfilesRelationManager;
use App\Models\UserBlocks;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserBlocksResource extends Resource
{
    protected static ?string $model = UserBlocks::class;

    /**
     * The resource navigation icon.
     */
    protected static ?string $navigationIcon = 'heroicon-o-user-minus';

    /**
     * The settings navigation group.
     */
    protected static ?string $navigationGroup = 'User';

    /**
     * The settings navigation sort order.
     */
    protected static ?int $navigationSort = 3;

    /**
     * Get the navigation badge for the resource.
     */
    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
				TextColumn::make('blockedBy.name')
					->searchable(),

				TextColumn::make('user.name')
					->searchable(),

                TextColumn::make('reason')
                    ->searchable(),

                TextColumn::make('from_date')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('to_date')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            UserProfilesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserBlocks::route('/'),
            'create' => Pages\CreateUserBlocks::route('/create'),
            'edit' => Pages\EditUserBlocks::route('/{record}/edit'),
        ];
    }
}
