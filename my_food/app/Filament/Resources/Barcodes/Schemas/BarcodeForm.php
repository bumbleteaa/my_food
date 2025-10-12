<?php

namespace App\Filament\Resources\Barcodes\Schemas;

use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BarcodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //Main table information section
                Section::make('Table Information')
                ->description('Table Details')
                ->schema([
                    TextInput::make('table_numbers')
                        ->label('Table Number')
                        ->required()
                        ->unique(ignoreRecord: true) // Ensure that the value entered is unique in the database
                        ->placeholder('TABLE-01')
                        ->helperText('Must be unique table indentifier'),
                        Select::make('user_id')
                        ->label('Owner')
                        ->relationship('user', 'name')
                        ->required()
                        ->searchable()
                        ->preload()  
                        ->default(fn () => Auth::id()),
                ])
                ->columns(2),//make 2 column view

                Section::make('QR Code')
                    ->description('Upload or generate QR code')
                    ->schema([
                    FileUpload::make('images')
                        ->label('QR Code Images')
                        ->image()
                        ->directory('qrcodes')
                        ->visibility('public')
                        ->imageEditor()
                        ->imageEditorAspectRatios(['1:1']) //the width and height of the image must be equal ratio
                        ->maxSize(2048)
                        ->helperText('Upload QR code image or generate below!')
                        ->columnSpanFull(),

                    TextInput::make('qr_value')
                        ->label('QR Code URL')
                        ->url() //input must be URL 
                        ->required()
                        ->placeholder('https://yourapp.com/table/001')
                        ->helperText('URL that QR code will redirect')
                        ->columnSpanFull(),

                    TextEntry::make('qr_preview')
                        ->label('QR Code Preview')
                        ->view('filament.components.qr-preview')
                        ->visible(fn($record) => $record !== null)
                        ->columnSpanFull()
                ])
            ]); 
    }
}
