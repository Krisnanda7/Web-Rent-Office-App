<?php

namespace App\Filament\Resources\OfficeSpaceTransactions\Pages;

use App\Filament\Resources\OfficeSpaceTransactions\OfficeSpaceTransactionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOfficeSpaceTransactions extends ListRecords
{
    protected static string $resource = OfficeSpaceTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
