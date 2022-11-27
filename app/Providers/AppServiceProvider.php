<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    private $initFacades = [
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach($this->initFacades as $key => $class) {
            $this->app->singleton($key, function () use($class) {
                return new $class();
            });
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
