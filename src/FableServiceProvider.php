<?php

namespace ThomDavis\Fable;

use Illuminate\Support\ServiceProvider;

class FableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], ['fable', 'fable-migrations']);
    }

    public function register()
    {
    }
}