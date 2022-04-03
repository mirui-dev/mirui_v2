<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Index;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Dashboard\Contactus;
use App\Http\Livewire\Dashboard\Aboutus;
use App\Http\Controllers\CustomAuthController;

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


Route::get('contactus',Contactus::class)->name('mirui.contactus');

Route::get('aboutus',Aboutus::class)->name('mirui.aboutus');

Route::get('/login',[CustomAuthController::class,'login'])->middleware('alreadyLoggedIn');
Route::get('/register',[CustomAuthController::class,'register'])->middleware('alreadyLoggedIn');
Route::post('/register-user',[CustomAuthController::class,'registerUser'])->name('register-user');
Route::post('/login-user',[CustomAuthController::class,'loginUser'])->name('login-user');
Route::get('/dashboard', [CustomAuthController::class,'dashboard'])->middleware('isLoggedIn');
Route::get('/logout',[CustomAuthController::class,'logout']);
