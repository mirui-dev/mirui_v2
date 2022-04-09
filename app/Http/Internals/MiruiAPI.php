<?php

namespace App\Http\Internals;

class MiruiAPI{

    public function generateToken(){
        return auth()->user()->createToken('mirui-api-common')->plainTextToken;
    }

    public function revokeToken(){
        return auth()->user()->tokens()->delete();
    }

}
