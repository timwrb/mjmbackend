<?php

namespace App\Filament\Dashboard\Resources\JobpostResource\Pages;

use App\Filament\Dashboard\Resources\JobpostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJobpost extends EditRecord
{
    protected static string $resource = JobpostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
