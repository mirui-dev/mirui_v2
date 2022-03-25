<?php

namespace App\Http\Livewire\Dashboard\Subcontent;

use Livewire\Component;
use App\Models\Movie;
use App\Models\User;
use App\Models\UserMovie;

class CartCheckout extends Component
{
    public $totalMovie;
    public $coin=5;
    public $totalCoin=0;
    public $userCoin=0;
    public $checkOutMsg="";
    public $payBtn;

    public function render()
    {
        return view('livewire.dashboard.subcontent.cart-checkout');
    }

    public function mount(){
        self::calculateTotal();
    }

    public function calculateTotal(){   
        //total coin for movie in the cart
        $this->totalMovie = count(request()->session()->get('internals.cart')??[]);
        $this->totalCoin = $this->totalMovie * $this->coin;
        
        //user's coin
        $this->userCoin = auth()->user()->coin;
        
        if($this->userCoin >= $this->totalCoin){
            $this->checkOutMsg = "ready for checkout.";
        }
        else{
            $this->checkOutMsg = "however your coins balance is low.";
            $this->payBtn = 'disabled';
        }
    }

    public function checkout(){
        //update userCoin
        auth()->user()->coin = $this->userCoin - $this->totalCoin;
        auth()->user()->save();

        //insert into db
        $cartMovie = request()->session()->get('internals.cart');
        foreach($cartMovie as $cartMovieID){
            $newEntry = new userMovie();
            $newEntry->user_id = auth()->user()->id;
            $newEntry->movie_id = $cartMovieID->id;
            $newEntry->save();
        }
        
        //destroy session
        session()->forget('internals.cart');
        $this->emit('dashboard.content.cart.refresh');
        $this->emit('internals.cart.updateCartCount');
    } 
}
