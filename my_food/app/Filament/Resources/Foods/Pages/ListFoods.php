<?php

namespace App\Filament\Resources\Foods\Pages;

use App\Filament\Resources\Foods\FoodsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFoods extends ListRecords
{
    protected static string $resource = FoodsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
