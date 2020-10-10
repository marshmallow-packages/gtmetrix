<?php

namespace Marshmallow\GTMetrix;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->mergeConfigFrom(
            __DIR__.'/../config/gtmetrix.php',
            'gtmetrix'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('marshmallow-gtmetrix-field', __DIR__.'/../dist/js/field.js');
            Nova::style('marshmallow-gtmetrix-field', __DIR__.'/../dist/css/field.css');
        });

        $this->publishes([
            __DIR__ . '/../config/gtmetrix.php' => config_path('gtmetrix.php'),
        ]);
    }
}
