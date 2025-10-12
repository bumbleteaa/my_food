<?php

namespace App\Filament\Resources\Barcodes\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Schemas\Components\View;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BarcodesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('table_numbers')
                    ->label('Table Number')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->tooltip('Click to copy'),
                ImageColumn::make('image')
                    ->label('QR Code')
                    ->disk('public')
                    ->imageSize(80)
                    ->square(),
                TextColumn::make('qr_value')
                    ->label('QR Code URL')
                    ->limit(30)
                    ->copyable()
                    ->tooltip(fn ($record) => $record->qr_value),
                TextColumn::make('user.name')
                    ->label('Owner')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                 TextColumn::make('transactions_count')
                    ->label('Orders Items')
                    ->counts('transactions')
                    ->alignCenter()
                    ->sortable()
                    ->badge()
                    ->color('success'),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),
                
            ])
            ->filters([
                SelectFilter::make('user')
                    ->label('Owner')
                    ->relationship('user', 'name'),
            ])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
