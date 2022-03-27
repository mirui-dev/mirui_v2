<?php

namespace App\Http\Livewire\Dashboard\Content;

use Livewire\Component;

// use App\Support\Facades\Cart as InternalCart;
// use App\Models\Movie;

class Cart extends Component
{

    public $isCheckoutApplicable = false;

    protected $listeners = [
        'dashboard.content.cart.refresh' => 'mount',
    ];

    public function render()
    {
        // dump(InternalCart::add(Movie::find(1)));
        // dump(InternalCart::all());
        return view('livewire.dashboard.content.cart');
    }

    public function mount(){
        $this->isCheckoutApplicable = boolval(count(auth()->user()->cart));
    }

}
