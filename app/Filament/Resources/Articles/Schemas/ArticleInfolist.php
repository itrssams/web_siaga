<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ArticleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('thumbnail')
                    ->label('Thumbnail')
                    ->placeholder('-'),
                TextEntry::make('title')
                    ->label('Judul'),
                TextEntry::make('slug'),
                TextEntry::make('excerpt')
                    ->label('Ringkasan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('content')
                    ->label('Isi Artikel')
                    ->columnSpanFull(),
                TextEntry::make('author')
                    ->label('Penulis')
                    ->placeholder('-'),
                TextEntry::make('published_at')
                    ->label('Tanggal Publish')
                    ->dateTime()
                    ->placeholder('-'),
                IconEntry::make('is_published')
                    ->label('Publish')
                    ->boolean(),
                IconEntry::make('is_featured')
                    ->label('Unggulan')
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
