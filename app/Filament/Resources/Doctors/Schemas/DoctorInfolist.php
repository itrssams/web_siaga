<?php

namespace App\Filament\Resources\Doctors\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DoctorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->placeholder('-'),
                TextEntry::make('name')
                    ->label('Nama'),
                TextEntry::make('specialization.name')
                    ->label('Spesialisasi')
                    ->placeholder('-'),
                TextEntry::make('polyclinic.name')
                    ->label('Poliklinik')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
