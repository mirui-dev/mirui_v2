<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Subcontentnav extends Component
{

    public $subcontentVisibilityClass = ' '; 
    protected $subcontentVisibleClass = 'active';
    protected $subcontentNotVisibleClass = ' ';

    protected $listeners = ['dashboard.subcontentnav.itemStateHandler' => 'itemStateHandler'];

    public function render()
    {
        return view('livewire.dashboard.subcontentnav');
    }

    public function handler($type){
        if($type == 'back'){
            $this->emit('dashboard.subcontent.viewHandler', null);
            self::itemStateHandler(false);
        }
    }

    public function itemStateHandler($isActive = false){
        if($isActive){
            $this->subcontentVisibilityClass = $this->subcontentVisibleClass;
        }else{
            $this->subcontentVisibilityClass = $this->subcontentNotVisibleClass;
        }
    }

}
