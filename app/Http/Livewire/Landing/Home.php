<?php

namespace App\Http\Livewire\Landing;

use Livewire\Component;

use App\Models\Movie;

class Home extends Component
{
    public $movie;

    public function render()
    {
        // dump($this->movie);
        return view('livewire.landing.home');
    }

    public function mount(){
        self::previewHandler();
    }

    public function previewHandler(){
        $this->movie = Movie::inRandomOrder()->whereNot('id', $this->movie->id ?? null)->first();
    }

}
