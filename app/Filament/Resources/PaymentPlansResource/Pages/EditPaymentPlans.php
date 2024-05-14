<?php

namespace App\Filament\Resources\PaymentPlansResource\Pages;

use App\Filament\Resources\PaymentPlansResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPaymentPlans extends EditRecord
{
    protected static string $resource = PaymentPlansResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
