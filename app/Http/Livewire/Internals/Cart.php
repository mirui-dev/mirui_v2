<?php

namespace App\Http\Livewire\Internals;

use Livewire\Component;

use Illuminate\Http\Request;
use App\Models\Movie;

//Cart Controller
class Cart extends Component
{
    public $cart = [];
    public $removeMsg="";

    protected $listeners = [
        'internals.cart.addToCart' => 'addToCart',
        'internals.cart.removeFromCart' => 'removeFromCart',
        //'cart.refresh' => 'updateCartCount',
        'internals.cart.updateCartCount' => 'updateCartCount',
    ];

    public function render()
    {
        return view('livewire.internals.cart');
    }

    public function addToCart(Movie $movie){
        // dump('wow');
        // array_push($this->cart, $movie);
        // self::syncCart();
        // dump($this->cart);
        
        $isAddMovie = true;
        $cart = request()->session()->get('internals.cart');
        if(!is_null($cart)){
            foreach($cart as $cartItem){
                if($cartItem->id==$movie->id){
                    $this->emit('internals.cart', false);
                    $isAddMovie = false;
                    break;
                }
            }
        }
        if($isAddMovie){
            request()->session()->push('internals.cart', $movie);
            $this->emit('internals.cart', true);
        }
        self::updateCartCount();
        //session()->flash('message', 'Movie addedd to cart successfully');
        //return redirect()->to('/dashboard');
        //return redirect('/dashboard')->with('successMsg', 'Movie addedd to cart successfully');
    }    
    
    public function removeFromCart(Movie $movie){
        $counter=0;
        $cart = request()->session()->get('internals.cart', $movie);
        if(!is_null($cart)){
            foreach($cart as $cartItem){
                if($cartItem->id==$movie->id){
                    unset($cart[$counter]);
                    break;
                }
                $counter++;
            }
            request()->session()->put('internals.cart', $cart);
        }
        self::updateCartCount();
        
        //request()->session()->pull('internals.cart', $movie);
        //session()->flash('message', 'Movie remove from cart successfully');
        //return redirect('/browse');
    }

    public function updateCartCount(){
        //$userId=request()->session()->get('user')['id'];
        //$cartMovie= request()->session()->get('movie')['id'];
        //return $cartMovie::where('user_id', $userId)->count();
        $cart = count(request()->session()->get('internals.cart')??[]);
        $this->emit('dashboard.nav.cartCount', $cart);
    } 

    //private function syncCart(){
        // dump(request()->session());
        // request()->session()->push('internals.cart', $this->cart);
    //}

}
