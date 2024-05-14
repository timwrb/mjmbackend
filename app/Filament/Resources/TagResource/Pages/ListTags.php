<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ListTags extends ListRecords
{
    protected static string $resource = TagResource::class;

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
            ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'praktikum')),

        ];
    }
}
