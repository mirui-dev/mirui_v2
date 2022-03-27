<?php

namespace App\Http\Livewire\Dashboard\Content;

use Livewire\Component;

class Browse extends Component
{

    public $isAdmin = false;

    protected $subcontentnav_browseManage_SU = ['back', 'edit'];

    public function render()
    {
        return view('livewire.dashboard.content.browse');
    }

    public function mount(){
        $isAdmin = true;
        $this->isAdmin = $isAdmin;
    }

    public function createHandler(){
        $this->emit('dashboard.subcontent.viewHandler', 'browse-manage');
        // control subcontentnav. must emit from here rather than inside the component because emit not working in render() or mount(). 
        // ref: https://github.com/livewire/livewire/issues/598#issuecomment-764947653
        $this->emit('dashboard.subcontentnav.navStateHandler', $this->subcontentnav_browseManage_SU);
        $this->emit('dashboard.subcontentnav.navSubstateHandler', 'state.edit.editing');
    }

}
