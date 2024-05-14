<?php

namespace App\Filament\Resources\JobpostResource\Pages;

use App\Filament\Resources\JobpostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobposts extends ListRecords
{
    protected static string $resource = JobpostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
