<?php

namespace App\Filament\Dashboard\Resources\JobpostResource\Pages;

use App\Filament\Dashboard\Resources\JobpostResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListJobposts extends ListRecords
{
    protected static string $resource = JobpostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'Alle' => Tab::make(),
            'Job' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'job')),
            'Praktikum' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'intern')),

        ];
    }
}
