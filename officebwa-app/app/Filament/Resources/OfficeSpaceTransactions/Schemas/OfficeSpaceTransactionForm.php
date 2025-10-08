<?php

namespace App\Filament\Resources\OfficeSpaceTransactions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OfficeSpaceTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('booking_trx_id')
                    ->required()
                    ->maxLength(255),

                TextInput::make('phone_number')
                    ->required()
                    ->maxLength(255),

                TextInput::make('total_amount')
                    ->required()
                    ->numeric()
                    ->prefix('IDR'),
                
                TextInput::make('duration')
                    ->required()
                    ->numeric()
                    ->prefix('Days'),
                
                DatePicker::make('started_at')
                    ->required(),
                
                DatePicker::make('ended_at')
                    ->required(),

                Select::make('is_paid')
                    ->options([
                        true => 'Paid',
                        false => 'Not Paid',
                    ])
                    ->required(),
                
                Select::make('office_space_id')
                    ->relationship('officeSpace', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
