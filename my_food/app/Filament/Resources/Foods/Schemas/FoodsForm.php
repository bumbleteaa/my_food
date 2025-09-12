<?php

namespace App\Filament\Resources\Foods\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class FoodsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->required()
                ->columnSpanFull(),
                RichEditor::make('description')
                ->required()
                ->columnSpanFull(),
                FileUpload::make('image')
                ->image()
                ->directory('foods')
                ->required()
                ->columnSpanFull(),
                TextInput::make('price')
                ->required()
                ->numeric()
                ->columnSpanFull()
                ->prefix('Rp')
                ->reactive(),
                Toggle::make('is_promo')
                ->reactive(),
                Select::make('percent')
                ->options([
                    10 =>'10%',
                    25 =>'25%',
                    35 =>'35%',
                    50 =>'50%',
                ])
                ->columnSpanFull()
                ->reactive()
                ->hidden(fn($get) => !$get('is_promo'))
                ->afterStateUpdated(function($set, $get, $state){
                    if($get('is_promo') && $get('price') && $get('percent')){
                        $discount = ($get('price') * (int)$get('percent'))/100;
                        $set('price_afterdiscount', $get('price') - $discount);
                    }
                    else{
                        $set('price_afterdiscount', $get('price'));
                    }
                }),
                TextInput::make('price_afterdiscount')
                ->readOnly()
                ->numeric()
                ->prefix('Rp')
                ->columnSpanFull()
                ->hidden(fn($get) => !$get('is_promo')),
                Select::make('categories_id')
                ->required()
                ->columnSpanFull()
                ->relationship('category','name'),
            ]);
    }
}
