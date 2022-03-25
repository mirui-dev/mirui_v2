<?php

namespace App\Http\Livewire\Dashboard\Subcontent;

use Livewire\Component;

use App\Models\Movie;

class Browse extends Component
{

    public $movieid;
    public $movie = NULL;

    public $isAddToCart = false;
    public $addToCartMsg = '';
    // public $urlParam = NULL;

    // protected $queryString = ['urlParam' => ['as' => 'id']];
    // protected $listener = ['dashboard.subcontent.browse.contentHandler', 'contentHandler'];

    public $listeners = [
        'internals.cart' => 'addCartMsg'
    ];

    public function render()
    {
        $this->movie = Movie::find($this->movieid);
        // dump($this->movie);
        // $this->urlParam = $this->movie['id'];
        return view('livewire.dashboard.subcontent.browse');
    }

    //Emit event for internals.cart (controller)
    public function addToCart(Movie $movie)
    {
        // dump($movie);
        // Cart::addToCart($movie);
        $this->emit('internals.cart.addToCart', $movie);
    }

    public function addCartMsg($isAddToCart)
    {
        if($isAddToCart == true){
            $addToCartMsg = 'Movie addedd to cart successfully';
        }else{
            $addToCartMsg = 'Movie already addedd to cart.';
        }
        $this->addToCartMsg = $addToCartMsg;
    }
}
