<?php

namespace App\Filament\Resources\Foods\Pages;

use App\Filament\Resources\Foods\FoodsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFoods extends EditRecord
{
    protected static string $resource = FoodsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
