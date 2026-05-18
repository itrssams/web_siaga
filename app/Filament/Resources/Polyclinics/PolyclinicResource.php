<?php

namespace App\Filament\Resources\Polyclinics;

use App\Filament\Resources\Polyclinics\Pages\CreatePolyclinic;
use App\Filament\Resources\Polyclinics\Pages\EditPolyclinic;
use App\Filament\Resources\Polyclinics\Pages\ListPolyclinics;
use App\Filament\Resources\Polyclinics\Pages\ViewPolyclinic;
use App\Filament\Resources\Polyclinics\Schemas\PolyclinicForm;
use App\Filament\Resources\Polyclinics\Schemas\PolyclinicInfolist;
use App\Filament\Resources\Polyclinics\Tables\PolyclinicsTable;
use App\Models\Polyclinic;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PolyclinicResource extends Resource
{
    protected static ?string $model = Polyclinic::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $modelLabel = 'Poliklinik';

    protected static ?string $pluralModelLabel = 'Poliklinik';

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return PolyclinicForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PolyclinicInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PolyclinicsTable::configure($table);
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
            'index' => ListPolyclinics::route('/'),
            'create' => CreatePolyclinic::route('/create'),
            'view' => ViewPolyclinic::route('/{record}'),
            'edit' => EditPolyclinic::route('/{record}/edit'),
        ];
    }
}
