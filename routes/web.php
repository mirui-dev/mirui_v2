<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Index;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Dashboard\Contactus;
use App\Http\Livewire\Dashboard\Aboutus;

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
Route::get('/', Index::Class)->name('mirui.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', Dashboard::class)->name('mirui.dashboard');

Route::get('contactus',Contactus::class)->name('mirui.contactus');

Route::get('aboutus',Aboutus::class)->name('mirui.aboutus');

// Route::get('/dashboard', Dashboard::class)->name('mirui.dashboard');
