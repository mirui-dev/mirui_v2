<?php

namespace App\Http\Livewire\Dashboard\Subcontent\Transaction;

use Livewire\Component;

use App\Support\Facades\Cart;

class Checkout extends Component
{

    public $isInsufficientRam = false;  // isInsufficientCoin
    public $totalMovieCount = 0;
    public $totalMovieCoin = 0;
    public $userCoin = 0;
    protected $movieCoin = 5;
    public $isBuffering = false;

    protected $subcontentnav_checkout_processing = [];

    public function render()
    {
        return view('livewire.dashboard.subcontent.transaction.checkout');
    }

    public function mount(){
        // boot
        self::calculateTotal();
    }

    public function calculateTotal(){   
        //total coin for movie in the cart
        $this->totalMovieCount = count(auth()->user()->cart);
        $this->totalMovieCoin = $this->totalMovieCount * $this->movieCoin;

        //user's coin
        $this->userCoin = auth()->user()->coin ?? 1000;

        // true if not enough, else false. 
        $this->isInsufficientRam = !($this->userCoin >= $this->totalMovieCoin);
    }

    public function checkout(){

        // prevent escape subcontent view
        $this->emit('dashboard.subcontentnav.navStateHandler', $this->subcontentnav_checkout_processing);
        // show processing UI state
        $this->isBuffering = true;
        $this->emit('dashboard.subcontent.transaction.checkout.processing', $this->isBuffering);

        //update userCoin
        // auth()->user()->coin = $this->userCoin - $this->totalMovieCoin;
        // auth()->user()->save();

        //insert into db
        $userCart = auth()->user()->cart;
        foreach($userCart as $movie){
            // $newEntry = new MovieUser();
            // $newEntry->user_id = auth()->user()->id;
            // $newEntry->movie_id = $userMovie->id;
            // $newEntry->save();
            
            // refer Internals.Cart
            // ref: https://laravel.com/docs/9.x/eloquent-relationships#attaching-detaching
            auth()->user()->movies()->attach($movie->id);
        }

        //clear cart
        Cart::clear();
        // refresh views
        $this->emit('dashboard.nav.refresh');
        $this->emit('dashboard.content.browse.node.refresh');
        $this->emit('dashboard.content.cart.refresh');
        // $this->emit('internals.cart.updateCartCount');

        // proceed to success page
        $viewData = [
            'isBuffering' => false, 
        ];
        $this->emit('dashboard.subcontent.transaction.viewHandler', 'success', $viewData);
        $this->emit('dashboard.subcontent.transaction.checkout.processing', false);
    }
}
