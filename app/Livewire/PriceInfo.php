<?php

namespace App\Livewire;

use Livewire\Component;


class PriceInfo extends Component
{
    protected static ?string $label = 'Preisinformationen';


    public function render(): \Illuminate\View\View
    {
        return view('livewire.price-info');
    }
}
