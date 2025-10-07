<?php
namespace App\Filament\Resources\TransactionResource\RelationManagers\ItemsRelationManager;

use Filament\Schemas\Schema;
use App\Filament\Resources\Transactions\RelationManagers\RelationManager;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Table;
use Filament\Resources\TransactionItemsResource\Tables\TransactionItemsTable;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('food.name')
                    ->required()
                    ->label('Food Name')
                    ->disabled(),
                TextInput::make('quantity')
                    ->disabled(),
                TextInput::make('price')
                    ->disabled()
                    ->prefix('Rp. '),
                TextInput::make('subtotal')
                    ->disabled()
                    ->prefix('Rp. '),
            ]);
    }

    public static function table(Table $table): Table
    {
        return TransactionItemsTable::configure($table)
                ->headerActions([])
                ->actions([
                    EditAction::make()
                    ->label('Update Quantity'),
                ])
                ->bulkActions([]);
    }   
}