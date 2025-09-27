<?php

namespace App\Filament\Resources\TransactionItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                ->label('Created')
                ->dateTime('d/m/Y H:i')
                ->sortable(),
                TextColumn::make('updated_at')
                ->label('Updated')
                ->dateTime('d/m/Y H:i')
                ->sortable(),
                TextColumn::make('food.name')
                ->label('Food Name')
                ->searchable(),
                TextColumn::make('quantity')
                ->label('Quantity'),
                TextColumn::make('price')
                ->label("Price")
                ->money('IDR'),
                TextColumn::make('subtotal')
                ->label('Subtotal')
                ->money("IDR"),
            ])
            ->filters([])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
