<?php

namespace App\Filament\Resources\OfficeSpaces\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class OfficeSpaceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->helperText('Gunakan nama data dengan tepat.')
                    ->required()
                    ->maxLength(255),

                TextInput::make('address')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('thumbnail')
                    ->disk('public')
                    ->directory('office')
                    ->image()
                    ->required(),

                Textarea::make('about')
                    ->helperText('Berikan  Deskripsi singkat mengenai ruang kantor ini.')
                    ->required()
                    ->rows(10)
                    ->cols(20),

                Repeater::make('photos')
                    ->relationship('photos')
                    ->schema([
                        FileUpload::make('photo')
                            ->disk('public')
                            ->directory('office')
                            ->required(),
                    ]),

                Repeater::make('benefits')
                    ->relationship('benefits')
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                    ]),

                Select::make('city_id')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('IDR'),

                TextInput::make('duration')
                    ->required()
                    ->numeric()
                    ->suffix('Days'),

                Select::make('is_open')
                    ->options ([
                        true => 'open',
                        false => 'close',
                    ])
                    ->required(),

                Select::make('is_full_booked')
                    ->options ([
                        true => 'Not Available',
                        false => 'Available',
                    ])
                    ->required(),

                TextInput::make('rating')
                    ->required()
                    ->numeric(),
            ]);
    }
}
