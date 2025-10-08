<?php

namespace App\Filament\Resources\OfficeSpaces\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Tables\Filters\SelectFilter;

class OfficeSpacesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                ImageColumn::make('thumbnail'),
                
                TextColumn::make('rating'),

                TextColumn::make('city.name')
                ->searchable(),

                IconColumn::make('is_full_booked')
                    ->boolean()

                    ->trueColor('danger')
                
                    ->falseColor('success')

                    ->trueIcon('heroicon-o-X-Circle')

                    ->falseIcon('heroicon-o-Check-Circle')

                    ->label('Available'),
            ])
            ->filters([
                SelectFilter::make('city_id')
                ->label('City')
                ->relationship('city', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
