<?php

namespace App\Http\Livewire\Dashboard\Content;

use Livewire\Component;

class Browse extends Component
{

    public $isAdmin = false;

    public function render()
    {
        return view('livewire.dashboard.content.browse');
    }

    public function mount(){
        $isAdmin = true;
        $this->isAdmin = $isAdmin;
    }

    public function createHandler(){
        $this->emit('dashboard.subcontent.viewHandler', 'browse-create');
    }

}
