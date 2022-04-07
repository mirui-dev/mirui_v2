<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Logout;
use App\Http\Livewire\Auth\Register;

Route::get('/', function(){
    return redirect(route('mirui.auth.login'));
})->name('mirui.auth');
Route::get('/login', Login::class)->name('mirui.auth.login');
Route::get('/register', Register::class)->name('mirui.auth.register');
Route::get('/logout', Logout::class)->name('mirui.auth.logout')->withoutMiddleware('guest');   // https://laravel.com/docs/9.x/middleware#excluding-middleware
