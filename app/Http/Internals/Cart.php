<?php

namespace App\Http\Internals;

use App\Models\Movie;

class Cart{

    // ref: https://laravel.com/docs/9.x/eloquent-relationships#attaching-detaching

    public function add(Movie $movie){
        // dump(auth()->user()->cart()->toggle($movie->id));
        return auth()->user()->cart()->attach($movie->id);
    }

    public function remove(Movie $movie){
        // self::add($movie);
        return auth()->user()->cart()->detach($movie->id);
    }

    // not needed because retrieve using auth()->user()->cart
    // public function all(){
    //     return auth()->user()->cart;
    // }

    public function clear(){
        return auth()->user()->cart()->detach();
    }

}
