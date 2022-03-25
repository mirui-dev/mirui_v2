<?php

namespace App\Http\Livewire\Dashboard\Content;

use Livewire\Component;
use App\Models\User;
use App\Models\UserMovie;

class Profile extends Component
{
    public $currentCoin=0;

    public function render()
    {
        return view('livewire.dashboard.content.profile');
    }

    public function mount(){
        self::getCurrentCoin();
    }

    public function getCurrentCoin(){
        $this->currentCoin = auth()->user()->coin;
    }

    public function topupHandler(){
        $this->emit('dashboard.subcontent.viewHandler', 'profile-topup');
    } 
}
