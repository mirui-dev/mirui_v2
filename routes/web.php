<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Landing\Home;
use App\Http\Livewire\Landing\Aboutus;
use App\Http\Livewire\Landing\Contactus;
use App\Http\Livewire\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// landing page (unauthenticated)
Route::get('/', Home::class)->name('mirui.landing');
Route::get('/aboutus', Aboutus::class)->name('mirui.landing.aboutus');
Route::get('/contactus', Contactus::class)->name('mirui.landing.contactus');

Route::get('/dashboard', Dashboard::class)->name('mirui.dashboard');
