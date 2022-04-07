<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

use Illuminate\Validation\Validator;

use App\Support\Facades\MiruiAuth;
// use App\Models\User;

class Register extends Component
{

    public $name = null;
    public $username = null;
    public $password = null;
    public $password_confirmation = null;   // https://laravel.com/docs/9.x/validation#rule-confirmed
    public $email = null;

    public function render()
    {
        return view('livewire.auth.register');
    }

    public function authHandler(){
        // dump($this->username);
        $auth = MiruiAuth::register($this->name, $this->username, $this->email, $this->password, $this->password_confirmation);
        if($auth === true){
            $this->emit('common.notification.new', '<p>Account registered. Redirecting to login...</p>', 'darkgreen');
            return redirect()->route('mirui.auth');
        }else if($auth instanceof Validator){
            // dump('wow');
            foreach($auth->errors()->all() as $errors){
                $this->emit('common.notification.new', '<p>'.$errors.'</p>', 'darkorange');
            }
        }else{
            $this->emit('common.notification.new', '<p>Registration failed. Ensure that all details are filled in correctly. </p>', 'darkred');
        }
    }

}
