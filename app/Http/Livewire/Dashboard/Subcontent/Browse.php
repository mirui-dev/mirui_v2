<?php

namespace App\Http\Livewire\Dashboard\Subcontent;

use Livewire\Component;

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

}
