<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Support\Facades\MiruiXML;

Route::get('/movies/raw', function(){
    return MiruiXML::showMovies();
});
Route::get('/movies', function(){
    return MiruiXML::showMoviesXSLT();
});