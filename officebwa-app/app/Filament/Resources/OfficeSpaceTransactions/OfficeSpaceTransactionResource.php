<?php

namespace App\Filament\Resources\OfficeSpaceTransactions;

use App\Filament\Resources\OfficeSpaceTransactions\Pages\CreateOfficeSpaceTransaction;
use App\Filament\Resources\OfficeSpaceTransactions\Pages\EditOfficeSpaceTransaction;
use App\Filament\Resources\OfficeSpaceTransactions\Pages\ListOfficeSpaceTransactions;
use App\Filament\Resources\OfficeSpaceTransactions\Schemas\OfficeSpaceTransactionForm;
use App\Filament\Resources\OfficeSpaceTransactions\Tables\OfficeSpaceTransactionsTable;
use App\Models\OfficeSpaceTransaction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfficeSpaceTransactionResource extends Resource
{
    protected static ?string $model = OfficeSpaceTransaction::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Schema $schema): Schema
    {
        return OfficeSpaceTransactionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OfficeSpaceTransactionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOfficeSpaceTransactions::route('/'),
            'create' => CreateOfficeSpaceTransaction::route('/create'),
            'edit' => EditOfficeSpaceTransaction::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
