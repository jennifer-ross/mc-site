<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatResource\Pages;
use App\Filament\Resources\ChatResource\RelationManagers;
use App\Models\Chat;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ChatResource extends Resource
{
	protected static ?string $model = Chat::class;

	protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

	/**
	 * The resource navigation group.
	 */
	protected static ?string $navigationGroup = 'Chat';

	/**
	 * The resource navigation sort order.
	 */
	protected static ?int $navigationSort = 1;

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
				TextColumn::make('owner.name')
					->searchable(),
				TextColumn::make('type')
					->sortable()
					->searchable(),
				TextColumn::make('visibility')
					->sortable()
					->searchable(),
				TextColumn::make('name')
					->searchable(),
				TextColumn::make('created_at')
					->sortable(),
				TextColumn::make('updated_at')
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
			//
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ListChats::route('/'),
			'create' => Pages\CreateChat::route('/create'),
			'edit' => Pages\EditChat::route('/{record}/edit'),
		];
	}
}
