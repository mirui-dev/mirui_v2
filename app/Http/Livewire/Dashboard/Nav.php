<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Nav extends Component
{

    public $isAdmin = false;
    public $greeterContent = 'LOADING';
    public $libraryClass = '';
    public $browseClass = '';
    public $cartClass = '';
    public $profileClass = '';
    private $activeStateClass = ' active ';

    protected $listeners = [
        // 'Nav.navHandler' => 'navHandler', 
        'dashboard.nav.itemStateHandler' => 'itemStateHandler',
        'dashboard.nav.refresh' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.dashboard.nav');
    }

    public function mount(){
        $currTime = now()->timezone('Asia/Kuala_Lumpur');  // https://carbon.nesbot.com/docs/#api-localization
        if($currTime->hour < 13 ){
            $greeterContent = 'GOOD MORNING';
        }else if($currTime->hour < 17){
            $greeterContent = 'GOOD AFTERNOON';
        }else{
            $greeterContent = 'GOOD EVENING';
        }

        // if(!auth()->access){
        //     $greeterContent = 'ADMINISTRATOR';
        //     $isAdmin = true;
        // }

        $this->greeterContent = $greeterContent;
        $this->isAdmin = $isAdmin ?? false;
    }

    public function handler($content){
        $this->emit('dashboard.content.viewHandler', $content);
    }

    public function itemStateHandler($content, $isActive = false){
        if($isActive){
            if($content == 'library'){
                $this->libraryClass = str_replace($this->activeStateClass, '', $this->libraryClass);
                $this->libraryClass .= $this->activeStateClass;
            }
            if($content == 'browse'){
                $this->browseClass = str_replace($this->activeStateClass, '', $this->browseClass);
                $this->browseClass .= $this->activeStateClass;
            }
            if($content == 'cart'){
                $this->cartClass = str_replace($this->activeStateClass, '', $this->cartClass);
                $this->cartClass .= $this->activeStateClass;
            }
            if($content == 'profile'){
                $this->profileClass = str_replace($this->activeStateClass, '', $this->profileClass);
                $this->profileClass .= $this->activeStateClass;
            }
        // }else{
        //     $this->currentContent = NULL;
        // }
        }

        if($content != 'library'){
            $this->libraryClass = str_replace($this->activeStateClass, '', $this->libraryClass);
        }
        if($content != 'browse'){
            $this->browseClass = str_replace($this->activeStateClass, '', $this->browseClass);
        }
        if($content != 'cart'){
            $this->cartClass = str_replace($this->activeStateClass, '', $this->cartClass);
        }
        if($content != 'profile'){
            $this->profileClass = str_replace($this->activeStateClass, '', $this->profileClass);
        }
    }
}
