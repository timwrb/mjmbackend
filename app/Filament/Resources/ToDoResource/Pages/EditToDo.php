<?php

namespace App\Filament\Resources\ToDoResource\Pages;

use App\Filament\Resources\ToDoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditToDo extends EditRecord
{
    protected static string $resource = ToDoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
