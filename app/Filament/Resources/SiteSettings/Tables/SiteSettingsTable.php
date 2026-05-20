<?php

namespace App\Filament\Resources\SiteSettings\Tables;

use App\Models\SiteSetting;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class SiteSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->label('Label')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('value')
                    ->label('Isi')
                    ->searchable(),
                TextColumn::make('placement')
                    ->label('Lokasi')
                    ->formatStateUsing(fn (string $state): string => SiteSetting::PLACEMENTS[$state] ?? $state)
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Tampil')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('placement')
                    ->label('Lokasi Tampil')
                    ->options(SiteSetting::PLACEMENTS),
                TernaryFilter::make('is_active')
                    ->label('Status tampil'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
