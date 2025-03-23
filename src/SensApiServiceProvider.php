<?php

namespace Odboxxx\SensApi;

use Illuminate\Support\ServiceProvider;

class SensApiServiceProvider extends ServiceProvider
{
    public function boot()
    {   
        $this->loadRoutesFrom(__DIR__ . '/../routes/sensapi.php');
    
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\InstallCommand::class,
        ]);
    }   
}