<?php

namespace App\Http\Livewire\Dashboard\Content;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        // this is very dangerous, it deletes all movies in the cart (yes, movies, not just cart item) because it is a relationship to movie model!!!
        // auth()->user()->cart()->delete();
        return view('livewire.dashboard.content.profile');
    }
}
