<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\App;

use App\Http\Internals\Cart;
use App\Http\Internals\MiruiAuth;
use App\Http\Internals\MiruiFile;
use App\Http\Internals\MiruiValidator;
use App\Http\Internals\MiruiXML;

class InternalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // bind key so that it returns the Facade class
        App::singleton('cart', function(){
            return new Cart;
        });
        App::singleton('mirui_auth', function(){
            return new MiruiAuth;
        });
        App::singleton('mirui_file', function(){
            return new MiruiFile;
        });
        App::singleton('mirui_validator', function(){
            return new MiruiValidator;
        });
        App::singleton('mirui_xml', function(){
            return new MiruiXML;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
