<?php

namespace App\Http\Livewire\Dashboard\Content;

use Livewire\Component;

// use App\Support\Facades\Cart as InternalCart;
// use App\Models\Movie;

class Cart extends Component
{

    public $isCheckoutApplicable = false;

    protected $subcontentnav_checkout = ['back'];

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

    public function checkoutHandler(){
        $this->emit('dashboard.subcontent.viewHandler', 'transaction', ['view' => 'checkout']);
        $this->emit('dashboard.subcontentnav.navStateHandler', $this->subcontentnav_checkout);
    }

}
