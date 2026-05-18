<?php

namespace App\Filament\Resources\Announcements\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AnnouncementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul')
                    ->maxLength(255)
                    ->required(),
                Textarea::make('content')
                    ->label('Isi Pengumuman')
                    ->rows(8)
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('attachment')
                    ->label('Lampiran')
                    ->directory('announcements')
                    ->downloadable()
                    ->openable()
                    ->default(null),
                DateTimePicker::make('published_at')
                    ->label('Tanggal Publish')
                    ->seconds(false),
                Toggle::make('is_published')
                    ->label('Publish')
                    ->default(false)
                    ->required(),
                Toggle::make('is_pinned')
                    ->label('Sematkan')
                    ->default(false)
                    ->required(),
            ]);
    }
}
