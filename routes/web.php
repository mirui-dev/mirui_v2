<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Dashboard;
use App\Http\Controllers\xml;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', Dashboard::class)->name('mirui.dashboard');

//xml
Route::get('/xml', [xml::class, 'showMovies'])->name('mirui.xml');

//xslt
Route::get('/xslt', [xml::class, 'showXSLTMovie'])->name('mirui.xslt');

//xpath
Route::get('/insertMovie', [xml::class, 'insertMovie'])->name('mirui.insertMovie');

Route::post('/insertMovie', [xml::class, 'submitInsertMovie'])->name('mirui.submitInsertMovie');

// Route::get('/dashboard', Dashboard::class)->name('mirui.dashboard');
