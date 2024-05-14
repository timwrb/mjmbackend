<?php

namespace App\Filament\Resources\PaymentPlansResource\Pages;

use App\Filament\Resources\PaymentPlansResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPaymentPlans extends ViewRecord
{
    protected static string $resource = PaymentPlansResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
