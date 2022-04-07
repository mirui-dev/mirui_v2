<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

use App\Support\Facades\MiruiAuth;

class Login extends Component
{

    public $username = null;
    public $password = null;

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function authHandler(){
        // dump($this->username);

        // $this->emit('common.notification.new', 'wow', 'red');
        // return;


        $auth = MiruiAuth::login($this->username, $this->password);
        if($auth){
            $this->emit('common.notification.new', '<p>Login Successful. </p>', 'darkgreen');
            // sleep(1);
            return redirect()->route('mirui.auth');
        }else{
            $this->emit('common.notification.new', '<p>Invalid login credentials. Please try again later. </p>', 'darkred');
        }
    }
}
