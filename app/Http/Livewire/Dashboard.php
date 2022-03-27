<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard');
    }

    public function mount(){
        // for debugging purposes, override debugbar. default enable on APP_DEBUG = TRUE. 
        // https://github.com/barryvdh/laravel-debugbar
        // \Debugbar::disable();
    }

}
