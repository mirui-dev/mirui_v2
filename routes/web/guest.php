<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Landing\Home;
use App\Http\Livewire\Landing\Aboutus;
use App\Http\Livewire\Landing\Contactus;

// landing page (unauthenticated)
Route::get('/', Home::class)->name('mirui.landing');
Route::get('/aboutus', Aboutus::class)->name('mirui.landing.aboutus');
Route::get('/contactus', Contactus::class)->name('mirui.landing.contactus');
