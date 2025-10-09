<?php

namespace App\Filament\Resources\Transactions\Tables;

use App\Filament\Resources\Foods\Pages\CreateFoods;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;


class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                ->label('Transaction Code')
                ->searchable()
                ->sortable()
                ->copyable()
                ->tooltip('click to copy'),
                TextColumn::make('name')
                ->label('Customer Name')
                ->searchable()
                ->sortable(),
                TextColumn::make('phone')
                ->searchable()
                ->toggleable(),
                TextColumn::make('barcode.code')
                ->label('Barcode')
                ->sortable()
                ->toggleable()
                ->tooltip(fn ($record)=>$record->barcode ? 'Relationship OK' : 'No barcode linked'),
                SelectColumn::make('payment_status')
                ->options([
                    'pending' => 'Pending',
                    'paid' => 'Paid',
                    'failed' => 'Failed',
                    'cancelled' => 'Cancelled',
                ])
                ->selectablePlaceholder(false),
                TextColumn::make('payment_method')
                ->badge()
                ->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('total_formatted')
                ->label('total')
                ->sortable('total')
                ->alignEnd(),


            ])
            ->filters([
                    SelectFilter::make('payment_status')
                    ->multiple()
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'cancelled' => 'Cancelled',
                    ]),
                    SelectFilter::make('payment_method')
                    ->multiple()
                    ->options([
                        'bank_transfer' => 'Bank Transfer',
                        'cash' => 'Cash',
                        'qris' => 'QRIS',
                    ]),
                    Filter::make('created_at')
                    ->schema([
                        DatePicker::make('created_from')
                        ->placeholder('From date'),
                        DatePicker::make('created_until')
                        ->placeholder('Until date'),
                    ])
                    ->query(function ($query, array $data)
                    {
                        return $query 
                        ->when($data['created_from'],
                            fn($query, $date)=> $query->whereDate('created_at', '>=', $date))
                        ->when($data['created_until'],
                            fn($query,$date)=> $query->whereDate('created_at','>='.$date));
                    })
                    ->indicateUsing(function(array $data): array {
                       $indicators = [];
                       if ($data['created_from'] ?? null){
                        $indicators[] = 'Created From'. Carbon::parse($data['created_from'])->toFormattedDateString();
                       }
                       if ($data['created_until'] ?? null){
                        $indicators[] = 'Created until'. Carbon::parse($data['created_until'])->toFormattedDateString();
                       }
                       return $indicators;
                        })
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
