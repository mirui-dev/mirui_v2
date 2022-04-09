<?php

namespace App\Http\Livewire\Dashboard\Content;

use Livewire\Component;

use Livewire\WithFileUploads;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;

use App\Models\User;
use App\Models\InternalStatic;
use App\Support\Facades\MiruiFile;
use App\Support\Facades\MiruiAPI;

class Profile extends Component
{
    use WithFileUploads;

    // public $user_coins = null;
    public $profile_picture = null;
    public $apiKey = null;

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

    // it triggers after file being uploaded. no use. 
    // public function updatingProfilePicture(){
    //     // injectNoti('<p>Uploading profile picture... ヾ( `ー´)シφ__', null, 6000);
    //     $this->emit('common.notification.new', '<p>Uploading profile picture... ヾ( `ー´)シφ__</p>', null, 6000);
    // }

    public function topupHandler(){
        $this->emit('dashboard.subcontent.viewHandler', 'transaction', ['view' => 'topup']);
        $this->emit('dashboard.subcontentnav.navStateHandler', $this->subcontentnav_topup);
    }

    public function profilePictureHandler(){

        $upload = MiruiFile::saveImage($this->profile_picture, $this->profile_picture_disk_dir, $this->profile_picture_disk);

        if($upload instanceof InternalStatic){
            auth()->user()->profile_picture_id = $upload->id;
            $setProfilePicture = auth()->user()->save();
            if(!$setProfilePicture){
                $this->emit('common.notification.new', '<p>An error occured while saving picture. <br>Changes discarded. </p>', null, 8000);
            }else{
                $this->emit('common.notification.new', '<p>Upload successss!!! („• ֊ •„)</p>', null, 6000);
                $this->profile_picture = null;
            }
        }else if($upload instanceof Validator){
            foreach($upload->errors()->all() as $errors){
                $this->emit('common.notification.new', '<p>'.$errors.'</p>', null, 8000);
            }
        }else{
            $this->emit('common.notification.new', '<p>An error occured while saving picture. <br>Changes discarded. </p>', null, 8000);
        }

        // if(!$saveLengzaiLenglui){
        //     // oh no, gigi! 
        // }else{
        //     // save image to resource
        //     $saveDashen = new InternalStatic();
        //     $saveDashen->disk = $this->profile_picture_disk;
        //     $saveDashen->path = $saveLengzaiLenglui;
        //     $saveDashen->save();
        //     // dump($saveDashen->save());
        //     // dump(Storage::url($saveDashen->path));

        //     // save resource id into user
        //     auth()->user()->profile_picture_id = $saveDashen->id;
        //     if(!auth()->user()->save()){
        //         // ah, gigi again....
        //     }else{
        //         $this->profile_picture = null;
        //     }
        // }
    }
    
    public function sanctumHandler(){
        // !is_null(auth()->user()->tokens()->latest()->first())

        // if(count(auth()->user()->tokens)){
        if(!is_null(auth()->user()->tokens()->latest()->first())){
            MiruiAPI::revokeToken();
            $this->apiKey = null; 
        }else{
            $this->apiKey = "Bearer ".MiruiAPI::generateToken();
            $this->emit('common.notification.new', '<p>API key generated. Please copy and save at a dry, safe place. </p>', null, 6000);
        }
    }

}
