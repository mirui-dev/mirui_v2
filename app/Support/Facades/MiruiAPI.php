<?php

namespace App\Support\Facades;

use Illuminate\Support\Facades\Facade;

class MiruiAPI extends Facade{

    // ref: https://laracasts.com/series/laravel-6-from-scratch/episodes/40
    // ref: https://onlinewebtutorblog.com/laravel-8-create-custom-facade-class-tutorial/
    // ref: https://laravel.com/docs/5.0/facades

    // 1. create the actual class
    // 2. create service provider, bind keyword to class
    // 3. create facade class returning keyword as accessor
    // 4. register service provider and facade alias in config/app.php

    protected static function getFacadeAccessor(){
        // the binding key in InternalServiceProvider
        return 'mirui_api';
    }

}

?>
