<?php

namespace App\Filament\Resources\Doctors\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DoctorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('photo')
                    ->label('Foto')
                    ->image()
                    ->directory('doctors')
                    ->imageEditor()
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->label('Nama Dokter')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('slug')
                    ->helperText('Boleh dikosongkan, sistem akan membuat slug dari nama dokter.')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                TextInput::make('specialist')
                    ->label('Spesialisasi')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('clinic')
                    ->label('Poli/Klinik')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('registration_number')
                    ->label('Nomor STR')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('practice_license_number')
                    ->label('Nomor SIP')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('phone')
                    ->label('Kontak')
                    ->tel()
                    ->maxLength(255)
                    ->default(null),
                Textarea::make('bio')
                    ->label('Profil Singkat')
                    ->rows(5)
                    ->default(null)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->required(),
                TextInput::make('sort_order')
                    ->label('Urutan Tampil')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
