<?php

namespace App\Filament\Resources\Certificates\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CertificateInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nama Sertifikat'),
                TextEntry::make('certificate_number')
                    ->label('Nomor Sertifikat')
                    ->placeholder('-'),
                TextEntry::make('issuer')
                    ->label('Penerbit')
                    ->placeholder('-'),
                TextEntry::make('file')
                    ->label('File'),
                TextEntry::make('issued_at')
                    ->label('Tanggal Terbit')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('expires_at')
                    ->label('Berlaku Sampai')
                    ->date()
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextEntry::make('sort_order')
                    ->label('Urutan Tampil')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
