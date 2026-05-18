<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul')
                    ->maxLength(255)
                    ->required(),
                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->directory('articles')
                    ->imageEditor()
                    ->default(null),
                Textarea::make('excerpt')
                    ->label('Ringkasan')
                    ->rows(3)
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->label('Isi Artikel')
                    ->rows(12)
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('author')
                    ->label('Penulis')
                    ->maxLength(255)
                    ->default(null),
                DateTimePicker::make('published_at')
                    ->label('Tanggal Publish')
                    ->seconds(false),
                Toggle::make('is_published')
                    ->label('Publish')
                    ->default(false)
                    ->required(),
                Toggle::make('is_featured')
                    ->label('Unggulan')
                    ->default(false)
                    ->required(),
            ]);
    }
}
