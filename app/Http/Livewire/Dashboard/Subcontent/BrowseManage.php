<?php

namespace App\Http\Livewire\Dashboard\Subcontent;

use Livewire\Component;

use Livewire\WithFileUploads;

use App\Support\Facades\Cart;
use App\Support\Facades\MiruiFile;
use App\Models\Movie;

class BrowseManage extends Component
{

    use WithFileUploads;

    public Movie $movie;
    public $movie_id = null;
    public $movie_visual_cover = null;
    public $movie_visual_poster = null;
    public $manageMode = 'create';

    protected $movie_visual_disk = 'mirui-static';
    protected $movie_visual_disk_dir = 'movie';

    // protected $subcontentnav = ['back', 'add'];

    protected $listeners = [
        'dashboard.subcontent.browseManage.save' => 'save',
        'dashboard.subcontent.browseManage.delete' => 'delete',
        'dashboard.subcontent.browseManage.addToCart' => 'addToCart',
        'dashboard.subcontent.browseManage.removeFromCart' => 'removeFromCart',
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
            // $this->movie_visual_cover = $this->movie->visual->cover ?? null;
            // $this->movie_visual_poster = $this->movie->visual->poster ?? null;
        }
    }

    public function save(){
        // show saving state
        // session()->flash('state.saving');
        // $this->movie->validate();

        try{
            if(!is_null($this->movie_visual_cover)){
                $uploadCover = MiruiFile::saveImage($this->movie_visual_cover, $this->movie_visual_disk_dir, $this->movie_visual_disk);
            }
            if(!is_null($this->movie_visual_poster)){
                $uploadPoster = MiruiFile::saveImage($this->movie_visual_poster, $this->movie_visual_disk_dir, $this->movie_visual_disk);
            }
        }catch(Exception $e){
            $this->emit('common.notification.new', '<p>An error occured while saving picture. <br>Image won\'t be saved. </p>', null, 8000);
        }

        if($uploadCover ?? null){
            $this->movie->visual->cover = $uploadCover->id;
        }

        if($uploadPoster ?? null){
            $this->movie->visual->poster = $uploadPoster->id;
        }

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

    public function addToCart(){
        Cart::add($this->movie);
        // $this->emit('dashboard.subcontentnav.cartStateHandler', true);
        $this->emit('dashboard.nav.refresh');
        $this->emit('dashboard.content.browse.node.refresh');
        $this->emit('dashboard.content.cart.refresh');
    }

    public function removeFromCart(){
        Cart::remove($this->movie);
        // $this->emit('dashboard.subcontentnav.cartStateHandler', false);
        $this->emit('dashboard.nav.refresh');
        $this->emit('dashboard.content.browse.node.refresh');
        $this->emit('dashboard.content.cart.refresh');
    }

}
