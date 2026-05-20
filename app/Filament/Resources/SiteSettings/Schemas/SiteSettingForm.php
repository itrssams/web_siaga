<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use App\Models\SiteSetting;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('label')
                    ->label('Label')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('key')
                    ->label('Key')
                    ->helperText('Gunakan key unik, misalnya phone, email, emergency.')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->required(),
                TextInput::make('value')
                    ->label('Isi')
                    ->maxLength(255),
                TextInput::make('url')
                    ->label('Link')
                    ->helperText('Opsional. Contoh: tel:0812..., mailto:info@..., atau link Google Maps.')
                    ->maxLength(255),
                Select::make('placement')
                    ->label('Lokasi Tampil')
                    ->options(SiteSetting::PLACEMENTS)
                    ->required()
                    ->default('footer_contact'),
                TextInput::make('icon')
                    ->label('Icon')
                    ->helperText('Opsional untuk catatan admin, misalnya phone, mail, map.')
                    ->maxLength(255),
                Toggle::make('is_active')
                    ->label('Tampilkan')
                    ->default(true)
                    ->required(),
                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->required()
                    ->default(0),
            ]);
    }
}
