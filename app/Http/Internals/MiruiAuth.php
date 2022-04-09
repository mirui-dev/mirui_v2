<?php

namespace App\Http\Internals;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MiruiAuth{

    public function register($name, $username, $email, $password, $password_confirmation){

        // dump('wow');

        $validation = Validator::make(
            [
                'name' => $name, 
                'username' => $username,
                'email' => $email, 
                'password' => $password,
                'password_confirmation' => $password_confirmation,
            ],
            [
                'name' => 'required|min:1',
                'username' => 'required|unique:users|min:6',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:8'
            ],
            [
                'name' => 'Invalid name. Please enter again. ',
                'username' => 'Invalid username. Please enter again. ',
                'username.unique' => 'Username has been taken. Please enter again. ',
                'email' => 'Invalid email. Please enter again. ',
                'email.unique' => 'Email has been taken. Please enter again. ',
                'password' => 'Invalid password. Please enter again. ', 
                'password.confirmed' => 'Password do not match. Please enter again. ',
            ]
        );

        // dump('wow');
        
        if($validation->fails()){
            // https://laravel.com/docs/9.x/validation#working-with-error-messages
            // dump($validation);
            return $validation;
        }

        // dump('wow');

        $user = new User();
        $user->name = $name;
        $user->username = $username;
        $user->email = $email;
        $user->password = Hash::make($password);

        $ret = $user->save();

        return $ret;
    }

    public function login($username, $password){

        // $request->validate([
        //     'email'=>'required|email',
        //     'password'=>'required|min:5|max:12'
        // ]);

        // https://laravel.com/docs/9.x/queries#where-not-clauses
        // example of closure usage
        $user = User::where(function($query) use ($username, $password){
            $query->where('email','=',$username)->orWhere('username', '=', $username);
        })->first();

        if($user){
            $auth = Hash::check($password, $user->password);
            if($auth){
                // https://laravel.com/docs/9.x/authentication#other-authentication-methods
                Auth::login($user);
                return true;
            }
        }
        
        return false;
    }

    public function logout(){
        // https://laravel.com/docs/9.x/authentication#logging-out
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return true;
    }

    public function generateToken(){
        return auth()->user()->createToken('mirui-api-common')->plainTextToken;
    }

    public function revokeToken(){
        return auth()->user()->tokens()->delete();
    }

}
