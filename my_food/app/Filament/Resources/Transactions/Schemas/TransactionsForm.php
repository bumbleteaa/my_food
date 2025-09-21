<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use PhpParser\Node\Stmt\Label;

class TransactionsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer Details')
                ->icon('heroicon-o-user')
                ->columns(2)
                ->collapsible()
                ->schema([
                    TextInput::make('name')
                    ->label('Customer Name')
                    ->disabled()
                    ->dehydrated(false)
                    ->formatStateUsing(fn($record) => $record->name ?? 'N/A'),
                    TextInput::make('phone')
                    ->label('Phone Number')
                    ->disabled()
                    ->dehydrated(false)
                    ->formatStateUsing(fn($record) => $record->phone ?? 'N/A'),
                    TextInput::make('email')
                    ->label('Email Address')
                    ->disabled()
                    ->dehydrated(false)
                    ->formatStateUsing(fn($record) => $record->email ?? 'Not Provided')
                    ->columnSpanFull(),
                ]),
                Section::make('Transaction Details')
                ->icon('heroicon-o-credit-card')
                ->columns(2)
                ->schema([
                    TextInput::make('code')
                    ->label('Transaction Code')
                    ->disabled()
                    ->dehydrated(false)
                    ->formatStateUsing(fn($record) => $record->code ?? 'Auto Generated')
                    ->extraInputAttributes(['class' => 'font-mono']),
                    TextInput::make('barcode.code')
                    ->label('Barcode')
                    ->disabled()
                    ->dehydrated(false)
                    ->formatStateUsing(fn($record) => $record->barcode->code ?? 'N A')
                    ->extraInputAttributes(['class'=>'font mono']),
                    TextInput::make('payment_method')
                    ->label('Payment Method')
                    ->disabled()
                    ->dehydrated(false)
                    ->required()
                    ->formatStateUsing(fn ($record)=>ucfirst(str_replace('-', ' ', $record?->payment_method ?? 'N/A'))),          
                    Select::make('payment_status')
                    ->label('Payment Status')
                    ->options([
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'cancelled' => 'Cancelled'
                    ])
                    ->required(),
                    TextInput::make('total_formatted')
                    ->label('Total Amount')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->columnSpanFull(),
                ]),
            ]);
    }
}
