<?php

namespace Softwarescares\Safaricomdaraja\app\Providers;

use Illuminate\Support\ServiceProvider;

class DarajaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
         
        
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php'); //-- web routes
        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php'); //-- api routes
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'safaricomdaraja'); //-- Package views
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations'); //-- migrations

        $this->publishes([
            __DIR__.'/../../resources/js/safaricomdaraja-js' => public_path('/safaricomdaraja-js'),
        ], 'safaricomdaraja-js');

        $this->mergeConfigFrom(
            __DIR__.'/../../config/safaricomdaraja.php', 'safaricomdaraja'
        );

        $this->publishes([
            __DIR__.'/../../config/safaricomdaraja.php' => config_path('safaricomdaraja.php'),
        ],'safaricomdaraja-config');

        $this->publishes([
            __DIR__.'/../../database/seeders' => public_path('../database/seeders'),
        ],'seeders');

        $this->publishes([
            __DIR__.'/../../public' => public_path('/'),
        ],'assets');
        
    }
}
