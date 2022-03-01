<?php

namespace App\Http\Livewire\Dashboard\Content\Browse;

use Livewire\Component;

use App\Models\Movie;

class Node extends Component
{

    public $movies;

    public function render()
    {
        return view('livewire.dashboard.content.browse.node');
    }

    public function mount(){
        $this->movies = Movie::all();
    }

    public function handler($id){
        // $data = ['movie' => $data]; // .......walaoeh
        // $data = ['movie' => Movie::find($id)];
        $data = ['movieid' => $id];
        // dump($data);
        // $this->emit('dashboard.subcontentnav.itemStateHandler', 'browse');
        $this->emit('dashboard.subcontent.viewHandler', 'browse', $data, $id);
        // $this->emit('dashboard.subcontentnav.itemStateHandler', 'browse');
    }

}
