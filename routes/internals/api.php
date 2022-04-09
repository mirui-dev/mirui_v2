<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Movie;
use App\Http\Controllers\API\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/swagger.json', function(){
    return response()->file(resource_path('mirui/api/swagger.json'));
});

Route::middleware('auth:sanctum')->group(function(){

    Route::apiResources([
        'movies' => Movie::class,
        'users' => User::class,
    ]);

});

