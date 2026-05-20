<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use App\Models\SiteSetting;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SiteSettingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('label')
                    ->label('Label'),
                TextEntry::make('key')
                    ->label('Key'),
                TextEntry::make('value')
                    ->label('Isi')
                    ->placeholder('-'),
                TextEntry::make('url')
                    ->label('Link')
                    ->placeholder('-'),
                TextEntry::make('placement')
                    ->label('Lokasi Tampil')
                    ->formatStateUsing(fn (string $state): string => SiteSetting::PLACEMENTS[$state] ?? $state),
                IconEntry::make('is_active')
                    ->label('Tampilkan')
                    ->boolean(),
                TextEntry::make('sort_order')
                    ->label('Urutan'),
            ]);
    }
}
