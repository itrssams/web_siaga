<?php

namespace App\Filament\Resources\DoctorSchedules\Schemas;

use App\Models\DoctorSchedule;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DoctorScheduleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('doctor.name')
                    ->label('Dokter'),
                TextEntry::make('doctor.polyclinic.name')
                    ->label('Poliklinik')
                    ->placeholder('-'),
                TextEntry::make('day_of_week')
                    ->label('Hari')
                    ->formatStateUsing(fn (int $state): string => DoctorSchedule::DAYS[$state] ?? '-'),
                TextEntry::make('start_time')
                    ->label('Jam Mulai')
                    ->time(),
                TextEntry::make('end_time')
                    ->label('Jam Selesai')
                    ->time(),
                TextEntry::make('room')
                    ->label('Ruangan')
                    ->placeholder('-'),
                TextEntry::make('note')
                    ->label('Catatan')
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
