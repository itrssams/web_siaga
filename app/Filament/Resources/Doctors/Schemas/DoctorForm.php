<?php

namespace App\Filament\Resources\Doctors\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class DoctorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('photo')
                    ->label('Foto')
                    ->disk('public')
                    ->image()
                    ->directory('doctors')
                    ->imageEditor()
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->label('Nama Dokter')
                    ->maxLength(255)
                    ->required(),
                Select::make('specialization_id')
                    ->label('Spesialisasi')
                    ->relationship(
                        'specialization',
                        'name',
                        fn (Builder $query): Builder => $query
                            ->where('is_active', true)
                            ->orderBy('sort_order')
                            ->orderBy('name'),
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('polyclinic_id')
                    ->label('Poliklinik')
                    ->relationship(
                        'polyclinic',
                        'name',
                        fn (Builder $query): Builder => $query
                            ->where('is_active', true)
                            ->orderBy('sort_order')
                            ->orderBy('name'),
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
