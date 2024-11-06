<?php

namespace ThomDavis\Fable;

use Illuminate\Support\ServiceProvider;

class FableServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->publishes([
            __DIR__.'/../config/fable.php' => config_path('fable.php'),
        ], 'fable-config');

        $this->publishes([
            __DIR__.'/../database/migrations/create_fable_table.php.stub' => $this->getMigrationFileName('create_permission_tables.php'),
        ], 'fable-migrations');
    }

    public function register()
    {
//        $this->app->scoped(Farmer::class, function () {
//            return new Farmer();
//        });

    }
}