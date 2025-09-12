<?php

namespace App\Filament\Resources\Foods;

use App\Filament\Resources\Foods\Pages\CreateFoods;
use App\Filament\Resources\Foods\Pages\EditFoods;
use App\Filament\Resources\Foods\Pages\ListFoods;
use App\Filament\Resources\Foods\Schemas\FoodsForm;
use App\Filament\Resources\Foods\Tables\FoodsTable;
use App\Models\Foods;
use BackedEnum;
use Filament\Forms\Form; 
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FoodsResource extends Resource
{
    protected static ?string $model = Foods::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Foods';

    public static function form(Schema $schema): Schema
    {
        return FoodsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FoodsTable::configure($table);
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
            'index' => ListFoods::route('/'),
            'create' => CreateFoods::route('/create'),
            'edit' => EditFoods::route('/{record}/edit'),
        ];
    }
}
