<?php

namespace App\Filament\Dashboard\Resources\ContactRequestResource\Pages;

use App\Filament\Dashboard\Resources\ContactRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateContactRequest extends CreateRecord
{
    protected static string $resource = ContactRequestResource::class;
}
