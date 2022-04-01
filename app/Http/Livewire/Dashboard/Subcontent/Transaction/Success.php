<?php

namespace App\Http\Livewire\Dashboard\Subcontent\Transaction;

use Livewire\Component;

class Success extends Component
{
    public $isBuffering = true;

    public function render()
    {
        return view('livewire.dashboard.subcontent.transaction.success');
    }

    public function mount(){
        // show non-buffering UI state (normal state)
        $this->isBuffering = false;
    }

}
