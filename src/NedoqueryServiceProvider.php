<?php

namespace Nedoquery\Api;

use Illuminate\Support\ServiceProvider;

class NedoqueryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('nedo.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'nedo'
        );
        
        $this->app->bind(NedoRequest::class, function ($app) {
            return new NedoRequest(
                $app->make('config')->get('nedo')
            );
        });
    }
}
