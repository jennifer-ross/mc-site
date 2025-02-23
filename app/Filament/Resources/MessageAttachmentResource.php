<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageAttachmentResource\Pages;
use App\Filament\Resources\MessageAttachmentResource\RelationManagers;
use App\Models\MessageAttachment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MessageAttachmentResource extends Resource
{
    protected static ?string $model = MessageAttachment::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

	/**
	 * The resource navigation group.
	 */
	protected static ?string $navigationGroup = 'Chat';

	/**
	 * The resource navigation sort order.
	 */
	protected static ?int $navigationSort = 4;

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
                //
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
            'index' => Pages\ListMessageAttachments::route('/'),
            'create' => Pages\CreateMessageAttachment::route('/create'),
            'edit' => Pages\EditMessageAttachment::route('/{record}/edit'),
        ];
    }
}
