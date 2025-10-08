<?php

namespace App\Filament\Resources\OfficeSpaceTransactions\Pages;

use App\Filament\Resources\OfficeSpaceTransactions\OfficeSpaceTransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditOfficeSpaceTransaction extends EditRecord
{
    protected static string $resource = OfficeSpaceTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
