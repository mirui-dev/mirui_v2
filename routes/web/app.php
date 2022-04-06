<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Dashboard;

Route::get('/', Dashboard::class)->name('mirui.dashboard');
