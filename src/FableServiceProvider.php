<?php

namespace ThomDavis\Fable;

use Illuminate\Support\ServiceProvider;

class FableServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->publishes([
            __DIR__.'/../config/fable.php' => config_path('fable.php'),
        ], 'fable');

        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], ['fable', 'fable-migrations']);
    }

    public function register()
    {
//        $this->app->scoped(Farmer::class, function () {
//            return new Farmer();
//        });

    }
}