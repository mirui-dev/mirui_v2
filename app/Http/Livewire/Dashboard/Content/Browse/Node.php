<?php

namespace App\Http\Livewire\Dashboard\Content\Browse;

use Livewire\Component;

use App\Models\Movie;

class Node extends Component
{

    public $movies;
    public $user_movies;
    public $user_cart;
    // public $isLibrary = false;
    public $nodeMode = null;

    protected $subcontentnav_browse = ['back', 'cart'];
    protected $subcontentnav_browse_library = ['back', 'watch'];
    protected $subcontentnav_browse_SU = ['edit', 'delete'];

    protected $listeners = [
        'dashboard.content.browse.node.refresh' => 'mount',
    ];

    public function render()
    {
        return view('livewire.dashboard.content.browse.node');
    }

    public function mount(){
        $this->user_movies = auth()->user()->movies;
        $this->user_cart = auth()->user()->cart;
        if($this->nodeMode == 'library'){
            $this->movies = $this->user_movies;
        }else if($this->nodeMode == 'cart'){
            $this->movies = $this->user_cart;
        }else{
            $this->movies = Movie::all();
        }
    }

    public function handler($id){

        self::mount();

        $isMovieInLibrary = $this->user_movies->find($id);
        $isMovieInCart = $this->user_cart->find($id);

        // $data = ['movie' => $data]; // .......walaoeh
        // $data = ['movie' => Movie::find($id)];
        $data = ['movie_id' => $id];
        // dump($data);
        // $this->emit('dashboard.subcontentnav.itemStateHandler', 'browse');
        $this->emit('dashboard.subcontent.viewHandler', 'browse', $data);

        // subcontent navbar management
        $subcontentnav_browse = ($this->nodeMode == 'library' || !is_null($isMovieInLibrary))
            ? $this->subcontentnav_browse_library
            : $this->subcontentnav_browse;
        $subcontentnav_browse = auth()->user() && true
            ? array_merge($subcontentnav_browse, $this->subcontentnav_browse_SU) 
            : $subcontentnav_browse;
        $this->emit('dashboard.subcontentnav.navStateHandler', $subcontentnav_browse);
        // check whether movie is in cart
        if(is_null($isMovieInLibrary) && !is_null($isMovieInCart)){
            $this->emit('dashboard.subcontentnav.cartStateHandler', true);
        }else{
            $this->emit('dashboard.subcontentnav.cartStateHandler', false);
        }
        
        // $this->emit('dashboard.subcontentnav.itemStateHandler', 'browse');
    }

}
