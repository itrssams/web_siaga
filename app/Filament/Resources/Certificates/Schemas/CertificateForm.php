<?php

namespace App\Filament\Resources\Certificates\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CertificateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Sertifikat')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('certificate_number')
                    ->label('Nomor Sertifikat')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('issuer')
                    ->label('Penerbit')
                    ->maxLength(255)
                    ->default(null),
                FileUpload::make('file')
                    ->label('File Sertifikat')
                    ->disk('public')
                    ->directory('certificates')
                    ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png', 'image/webp'])
                    ->downloadable()
                    ->openable()
                    ->required(),
                DatePicker::make('issued_at')
                    ->label('Tanggal Terbit'),
                DatePicker::make('expires_at')
                    ->label('Berlaku Sampai'),
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
