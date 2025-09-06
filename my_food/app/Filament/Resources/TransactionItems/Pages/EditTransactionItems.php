<?php

namespace App\Filament\Resources\TransactionItems\Pages;

use App\Filament\Resources\TransactionItems\TransactionItemsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTransactionItems extends EditRecord
{
    protected static string $resource = TransactionItemsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
