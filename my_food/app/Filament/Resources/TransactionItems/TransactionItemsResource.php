<?php

namespace App\Filament\Resources\TransactionItems;

use App\Filament\Resources\TransactionItems\Pages\CreateTransactionItems;
use App\Filament\Resources\TransactionItems\Pages\EditTransactionItems;
use App\Filament\Resources\TransactionItems\Pages\ListTransactionItems;
use App\Filament\Resources\TransactionItems\Schemas\TransactionItemsForm;
use App\Filament\Resources\TransactionItems\Tables\TransactionItemsTable;
use App\Models\TransactionItems;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TransactionItemsResource extends Resource
{
    protected static ?string $model = TransactionItems::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Transaction Items';

    public static function form(Schema $schema): Schema
    {
        return TransactionItemsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransactionItemsTable::configure($table);
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
            'index' => ListTransactionItems::route('/'),
            'create' => CreateTransactionItems::route('/create'),
            'edit' => EditTransactionItems::route('/{record}/edit'),
        ];
    }
}
