<?php

namespace App\Http\Livewire\Dashboard\Content;

use Livewire\Component;

class Profile extends Component
{

    // public $user_coins = null;

    private $subcontentnav_topup = ['back'];

    protected $listeners = [
        'dashboard.content.profile.refresh' => 'mount',
    ];

    public function render()
    {
        // this is very dangerous, it deletes all movies in the cart (yes, movies, not just cart item) because it is a relationship to movie model!!!
        // auth()->user()->cart()->delete();
        return view('livewire.dashboard.content.profile');
    }

    public function mount(){
        // $this->user_coins = auth()->user()->coins;
    }

    public function topupHandler(){
        $this->emit('dashboard.subcontent.viewHandler', 'transaction', ['view' => 'topup']);
        $this->emit('dashboard.subcontentnav.navStateHandler', $this->subcontentnav_topup);
    }
}
