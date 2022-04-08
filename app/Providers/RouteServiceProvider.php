<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            
            // please readup about this regarding usage of subdomains on localhost. 
            // https://stackoverflow.com/questions/1134290/cookies-on-localhost-with-explicit-domain

            // internals: /internals.mirui.co
            Route::domain('internals.'.env('SESSION_DOMAIN'))->group(function(){
                
                // internals: /internals.mirui.co/api
                Route::prefix('api')->middleware('api')
                    ->group(base_path('routes/internals/api.php'));

                // internals: /internals.mirui.co/xml
                Route::prefix('xml')->middleware(['web', 'auth'])
                    ->group(base_path('routes/internals/xml.php'));
                
            });

            Route::middleware('web')->group(function(){

                // web: /auth.mirui.co
                Route::domain('auth.'.env('SESSION_DOMAIN'))
                    ->middleware('guest')
                    ->group(base_path('routes/web/auth.php'));

                // web: /app.mirui.co
                Route::domain('app.'.env('SESSION_DOMAIN'))
                    ->middleware('auth')
                    ->group(base_path('routes/web/app.php'));

                // web: /mirui.co
                Route::domain(''.env('SESSION_DOMAIN'))
                    ->group(base_path('routes/web/guest.php'));

            });

        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
