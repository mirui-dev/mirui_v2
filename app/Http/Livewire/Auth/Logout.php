<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

use App\Support\Facades\MiruiAuth;

class Logout extends Component
{

    public function mount(){
        if(MiruiAuth::logout()){
            return redirect()->route('mirui.auth');
        }

        return false;
    }

}
