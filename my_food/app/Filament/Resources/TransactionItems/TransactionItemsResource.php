<?php

namespace App\Filament\Resources\TransactionItems;

use App\Filament\Resources\TransactionItems\Pages\ListTransactionItems;
use App\Filament\Resources\TransactionItems\Schemas\TransactionItemsForm;
use App\Filament\Resources\TransactionItems\Tables\TransactionItemsTable;
use App\Filament\Resources\Transactions\TransactionsResource;
use App\Models\TransactionItems;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TransactionItemsResource extends Resource
{
    protected static ?string $model = TransactionItems::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQrCode;

    protected static ?string $recordTitleAttribute = 'Transaction Items';

    public static bool $shouldRegisterNavigation = false;

    public static ?string $parentResource = TransactionsResource::class;

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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTransactionItems::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record) : bool 
    {
        return false;
    }

    public static function canDelete($record) : bool 
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }
}
