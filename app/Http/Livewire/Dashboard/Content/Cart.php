<?php

namespace App\Http\Livewire\Dashboard\Content;

use Livewire\Component;
use App\Models\Movie;

//Cart Display
class Cart extends Component
{
    public $checkoutBtn;

    public $listeners=[
        'dashboard.content.cart.refresh' => 'render',
    ];

    public function render()
    {
        return view('livewire.dashboard.content.cart', ['cart'=> request()->session()->get('internals.cart')]);
    }

    public function removeFromCart(Movie $movie)
    {
        $this->emit('internals.cart.removeFromCart', $movie);
        self::render();
    }
    
    public function checkoutHandler(){
        $cart = request()->session()->get('internals.cart');
        if(is_null($cart)){
            $this->checkoutBtn = 'disabled';
        }else{
            $this->emit('dashboard.subcontent.viewHandler', 'cart-checkout');
        }
    }
}

    

