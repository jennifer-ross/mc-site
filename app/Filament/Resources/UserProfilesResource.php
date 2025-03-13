<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserProfileResource\RelationManagers\UsersRelationManager;
use App\Filament\Resources\UserProfilesResource\Pages;
use App\Models\UserProfile;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserProfilesResource extends Resource
{
	/**
	 * The resource model.
	 */
	protected static ?string $model = UserProfile::class;

	/**
	 * The resource navigation icon.
	 */
	protected static ?string $navigationIcon = 'heroicon-o-user-group';

	/**
	 * The settings navigation group.
	 */
	protected static ?string $navigationGroup = 'User';

	/**
	 * The settings navigation sort order.
	 */
	protected static ?int $navigationSort = 2;

	/**
	 * Get the navigation badge for the resource.
	 */
	public static function getNavigationBadge(): ?string
	{
		return number_format(static::getModel()::count());
	}

	/**
	 * The resource form.
	 */
	public static function form(Form $form): Form
	{
		return $form
			->schema([
				TextInput::make('minecraft_id')
					->unique(ignoreRecord: true)
					->maxLength(255),

				TextInput::make('minecraft_name')
					->unique(ignoreRecord: true)
					->maxLength(255),
			]);
	}

	/**
	 * The resource table.
	 */
	public static function table(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('user.name')
					->searchable(),

				TextColumn::make('discord_id')
					->searchable(),

				TextColumn::make('minecraft_id')
					->searchable(),

				TextColumn::make('minecraft_name')
					->searchable(),

				TextColumn::make('created_at')
					->dateTime()
					->sortable(),

				TextColumn::make('updated_at')
					->dateTime()
					->sortable(),
			])
			->filters([
				//
			])
			->actions([
				EditAction::make(),
				DeleteAction::make(),
			])
			->bulkActions([
				BulkActionGroup::make([
					DeleteBulkAction::make(),
				]),
			])
			->emptyStateActions([
				CreateAction::make(),
			])->inverseRelationship('user');
	}

	/**
	 * The resource relation managers.
	 */
	public static function getRelations(): array
	{
		return [
			UsersRelationManager::class,
		];
	}

	/**
	 * The resource pages.
	 */
	public static function getPages(): array
	{
		return [
			'index' => Pages\ListUserProfiles::route('/'),
			'create' => Pages\CreateUserProfiles::route('/create'),
			'edit' => Pages\EditUserProfiles::route('/{record}/edit'),
		];
	}
}
