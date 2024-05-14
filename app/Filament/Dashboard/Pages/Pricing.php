<?php

namespace App\Filament\Dashboard\Pages;

use Filament\Pages\Page;

class Pricing extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationLabel = 'Preisinformationen';

    protected static ?string $title = '';

    protected static string $view = 'filament.dashboard.pages.pricing';

}
