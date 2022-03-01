<?php

namespace App\Http\Livewire\Dashboard\Subcontent;

use Livewire\Component;

use App\Models\Movie;

class Browse extends Component
{

    public $movieid;
    public $movie = NULL;
    // public $urlParam = NULL;

    // protected $queryString = ['urlParam' => ['as' => 'id']];
    // protected $listener = ['dashboard.subcontent.browse.contentHandler', 'contentHandler'];

    public function render()
    {
        $this->movie = Movie::find($this->movieid);
        // dump($this->movie);
        // $this->urlParam = $this->movie['id'];
        return view('livewire.dashboard.subcontent.browse');
    }

}
