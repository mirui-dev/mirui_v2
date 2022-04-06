<?php

namespace App\Http\Livewire\Landing;

use Livewire\Component;

class Navigation extends Component
{

    public $isFullPageNav = true;

    public function render()
    {
        return view('livewire.landing.navigation');
    }
}
