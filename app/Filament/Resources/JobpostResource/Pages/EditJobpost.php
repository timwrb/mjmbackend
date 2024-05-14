<?php

namespace App\Filament\Resources\JobpostResource\Pages;

use App\Filament\Resources\JobpostResource;
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
