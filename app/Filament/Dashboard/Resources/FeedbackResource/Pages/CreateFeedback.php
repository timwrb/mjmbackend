<?php

namespace App\Filament\Dashboard\Resources\FeedbackResource\Pages;

use App\Filament\Dashboard\Resources\FeedbackResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFeedback extends CreateRecord
{
    protected static string $resource = FeedbackResource::class;
}
