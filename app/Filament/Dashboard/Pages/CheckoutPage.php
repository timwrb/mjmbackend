<?php

namespace App\Filament\Dashboard\Pages;

use Filament\Pages\Page;

class CheckoutPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Bezahlen';

    protected static ?string $title = 'Bezahlen';
    protected static ?string $navigationGroup = 'Stellenanzeigen';
    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.dashboard.pages.checkout-page';
}
