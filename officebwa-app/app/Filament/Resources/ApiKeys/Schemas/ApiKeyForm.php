<?php

namespace App\Filament\Resources\ApiKeys\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class ApiKeyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('key')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
