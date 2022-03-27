<?php

namespace App\Http\Livewire\Dashboard\Subcontent;

use Livewire\Component;

use App\Support\Facades\Cart;
use App\Models\Movie;

class Browse extends Component
{

    public $movie_id;
    public $movie = NULL;
    // public $urlParam = NULL;

    // protected $queryString = ['urlParam' => ['as' => 'id']];
    protected $listeners = [
        'dashboard.subcontent.browse.handler' => 'handler',
        'dashboard.subcontent.browseManage.delete' => 'delete',
        'dashboard.subcontent.browseManage.addToCart' => 'addToCart',
        'dashboard.subcontent.browseManage.removeFromCart' => 'removeFromCart',
    ];

    public function render()
    {
        $this->movie = Movie::find($this->movie_id);
        // dump($this->movie);
        // $this->urlParam = $this->movie['id'];
        return view('livewire.dashboard.subcontent.browse');
    }

    public function handler(){
        $this->emit('dashboard.subcontent.viewHandler', 'browse-manage', ['movie_id' => $this->movie->id]);
    }

    public function delete(){
        $this->movie->delete();
        $this->emit('dashboard.subcontentnav.navSubstateHandler', 'state.delete.deleted');
        $this->emit('dashboard.content.browse.node.refresh');
        $this->emit('dashboard.subcontent.viewHandler');
    }

    public function addToCart(){
        Cart::add($this->movie);
        // $this->emit('dashboard.subcontentnav.cartStateHandler', true);
        $this->emit('dashboard.nav.refresh');
        $this->emit('dashboard.content.browse.node.refresh');
        $this->emit('dashboard.content.cart.refresh');
    }

    public function removeFromCart(){
        Cart::remove($this->movie);
        // $this->emit('dashboard.subcontentnav.cartStateHandler', false);
        $this->emit('dashboard.nav.refresh');
        $this->emit('dashboard.content.browse.node.refresh');
        $this->emit('dashboard.content.cart.refresh');
    }

}
