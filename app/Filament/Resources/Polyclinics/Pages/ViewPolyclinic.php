<?php

namespace App\Filament\Resources\Polyclinics\Pages;

use App\Filament\Resources\Polyclinics\PolyclinicResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPolyclinic extends ViewRecord
{
    protected static string $resource = PolyclinicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
