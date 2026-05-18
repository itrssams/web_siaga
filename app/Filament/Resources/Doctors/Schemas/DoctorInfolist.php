<?php

namespace App\Filament\Resources\Doctors\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DoctorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('slug'),
                TextEntry::make('specialist'),
                TextEntry::make('clinic')
                    ->placeholder('-'),
                TextEntry::make('photo')
                    ->placeholder('-'),
                TextEntry::make('registration_number')
                    ->placeholder('-'),
                TextEntry::make('practice_license_number')
                    ->placeholder('-'),
                TextEntry::make('phone')
                    ->placeholder('-'),
                TextEntry::make('bio')
                    ->placeholder('-')
                    ->columnSpanFull(),
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
