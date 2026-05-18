<?php

namespace App\Filament\Resources\Announcements\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AnnouncementInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->label('Judul'),
                TextEntry::make('slug')
                    ->placeholder('-'),
                TextEntry::make('content')
                    ->label('Isi Pengumuman')
                    ->columnSpanFull(),
                TextEntry::make('attachment')
                    ->label('Lampiran')
                    ->placeholder('-'),
                TextEntry::make('published_at')
                    ->label('Tanggal Publish')
                    ->dateTime()
                    ->placeholder('-'),
                IconEntry::make('is_published')
                    ->label('Publish')
                    ->boolean(),
                IconEntry::make('is_pinned')
                    ->label('Disematkan')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
