<?php

namespace App\Filament\Resources\Foods\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class FoodsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable(),
                ImageColumn::make('image'),
                TextColumn::make('price')
                ->money('IDR')
                ->sortable(),
                TextColumn::make('price_afterdiscount')
                ->money('IDR')
                ->sortable(),
                TextColumn::make('percent')
                ->sortable(),
                IconColumn::make('is_promo')
                ->boolean()
                ->sortable(),
                TextColumn::make('category.name')
                ->searchable(),  
                TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
