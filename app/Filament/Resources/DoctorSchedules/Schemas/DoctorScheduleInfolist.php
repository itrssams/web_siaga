<?php

namespace App\Filament\Resources\DoctorSchedules\Schemas;

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
                    ->label('Doctor'),
                TextEntry::make('day_of_week')
                    ->numeric(),
                TextEntry::make('start_time')
                    ->time(),
                TextEntry::make('end_time')
                    ->time(),
                TextEntry::make('clinic')
                    ->placeholder('-'),
                TextEntry::make('room')
                    ->placeholder('-'),
                TextEntry::make('note')
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('sort_order')
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
