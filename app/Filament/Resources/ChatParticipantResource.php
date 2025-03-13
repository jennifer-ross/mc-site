<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatParticipantResource\Pages;
use App\Filament\Resources\ChatParticipantResource\RelationManagers;
use App\Models\ChatParticipant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChatParticipantResource extends Resource
{
    protected static ?string $model = ChatParticipant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	/**
	 * The resource navigation group.
	 */
	protected static ?string $navigationGroup = 'Chat';

	/**
	 * The resource navigation sort order.
	 */
	protected static ?int $navigationSort = 2;

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
				TextColumn::make('user.name')
					->searchable(),
				TextColumn::make('chat.name')
					->searchable(),
				TextColumn::make('chat.id')
					->sortable(),
				TextColumn::make('role')
					->searchable(),
				TextColumn::make('joined_at')
					->sortable(),
				TextColumn::make('created_at')
					->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChatParticipants::route('/'),
            'create' => Pages\CreateChatParticipant::route('/create'),
            'edit' => Pages\EditChatParticipant::route('/{record}/edit'),
        ];
    }
}
