<?php

namespace App\Filament\Dashboard\Resources\JobpostResource\Pages;

use App\Filament\Dashboard\Resources\JobpostResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Builder;

class ViewJobpost extends ViewRecord
{
    protected static string $resource = JobpostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
