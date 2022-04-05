<?php

namespace App\Http\Livewire\Dashboard\Content;

use Livewire\Component;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\InternalStatic;

class Profile extends Component
{
    use WithFileUploads;

    // public $user_coins = null;
    public $profile_picture = null;

    private $subcontentnav_topup = ['back'];
    protected $profile_picture_disk = 'mirui-static-priv';
    protected $profile_picture_disk_dir = 'user';

    protected $listeners = [
        'dashboard.content.profile.refresh' => 'mount',
    ];

    public function render()
    {
        // this is very dangerous, it deletes all movies in the cart (yes, movies, not just cart item) because it is a relationship to movie model!!!
        // auth()->user()->cart()->delete();

        // dump(auth()->user()->internalResources()->profilePicture()->get());

        return view('livewire.dashboard.content.profile');
    }

    public function mount(){
        // $this->user_coins = auth()->user()->coins;
    }

    public function topupHandler(){
        $this->emit('dashboard.subcontent.viewHandler', 'transaction', ['view' => 'topup']);
        $this->emit('dashboard.subcontentnav.navStateHandler', $this->subcontentnav_topup);
    }

    public function profilePictureHandler(){
        // dump($this->profile_picture);
        $saveLengzaiLenglui = Storage::disk($this->profile_picture_disk)->putFile($this->profile_picture_disk_dir, $this->profile_picture);
        if(!$saveLengzaiLenglui){
            // oh no, gigi! 
        }else{
            // save image to resource
            $saveDashen = new InternalStatic();
            $saveDashen->disk = $this->profile_picture_disk;
            $saveDashen->path = $saveLengzaiLenglui;
            $saveDashen->save();
            // dump($saveDashen->save());
            // dump(Storage::url($saveDashen->path));

            // save resource id into user
            auth()->user()->profile_picture_id = $saveDashen->id;
            if(!auth()->user()->save()){
                // ah, gigi again....
            }else{
                $this->profile_picture = null;
            }
        }
    }
    
}
