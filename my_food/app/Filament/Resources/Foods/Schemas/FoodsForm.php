<?php

namespace App\Filament\Resources\Foods\Schemas;

use Filament\Schemas\Schema;

class FoodsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }
}
