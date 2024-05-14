<?php

namespace App\Filament\Dashboard\Resources\ContactRequestResource\Pages;

use App\Filament\Dashboard\Resources\ContactRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContactRequest extends ViewRecord
{
    protected static string $resource = ContactRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
