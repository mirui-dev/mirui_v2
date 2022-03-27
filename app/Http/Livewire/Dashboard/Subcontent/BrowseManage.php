<?php

namespace App\Http\Livewire\Dashboard\Subcontent;

use Livewire\Component;

use App\Models\Movie;

class BrowseManage extends Component
{

    public Movie $movie;
    public $movie_id = null;
    public $manageMode = 'create';

    // protected $subcontentnav = ['back', 'add'];

    protected $listeners = [
        'dashboard.subcontent.browseManage.save' => 'save',
        'dashboard.subcontent.browseManage.delete' => 'delete',
    ];

    // validation rules is required for model binding in livewire
    protected $rules = [
        'movie.rating' => '',
        'movie.score' => '',
        'movie.title' => '',
        'movie.title2' => '',
        'movie.description' => '',
        'movie.dateRelease' => '',
        'movie.language' => '',
        'movie.subtitle' => '',
        'movie.runtime' => '',
        'movie.genre' => '',
        'movie.country' => '',
        'movie.director' => '',
        'movie.cast' => '',
        'movie.description2' => '',
    ];

    public function render()
    {
        // dump('wow');
        // emit is not working from render/mount menthod. 
        // ref: https://github.com/livewire/livewire/issues/598#issuecomment-764947653
        
        // return view('livewire.dashboard.subcontent.browse-'.$this->manageMode);
        return view('livewire.dashboard.subcontent.browse-manage');
    }

    public function mount(){
        // initialization of typed property before usage
        // ERROR: typed property must not be accessed before initialization
        if(is_null($this->movie_id)){
            $this->movie = new Movie();
            $this->manageMode = 'create';
        }else{
            $this->movie = Movie::find($this->movie_id);
            $this->manageMode = 'edit';
        }
    }

    public function save(){
        // show saving state
        // session()->flash('state.saving');
        // $this->movie->validate();

        $this->movie->save();
        $this->emit('dashboard.subcontentnav.navSubstateHandler', 'state.edit.saved');
        $this->emit('dashboard.content.browse.node.refresh');
        
        if($this->manageMode == 'edit'){
            $this->emit('dashboard.subcontent.viewHandler', 'browse', ['movie_id' => $this->movie->id]);
        }else{
            $this->emit('dashboard.subcontent.viewHandler');
        }
    }

    public function delete(){
        $this->movie->delete();
        $this->emit('dashboard.subcontentnav.navSubstateHandler', 'state.delete.deleted');
        $this->emit('dashboard.content.browse.node.refresh');
        $this->emit('dashboard.subcontent.viewHandler');
    }

}
