<?php

namespace App\Filament\Resources\ToDoResource\Pages;

use App\Filament\Resources\ToDoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewToDo extends ViewRecord
{
    protected static string $resource = ToDoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
