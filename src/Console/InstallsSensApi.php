<?php

namespace Odboxxx\SenSapi\Console;

use Illuminate\Filesystem\Filesystem;

trait InstallsSensApi
{
    /**
     * Install the SensApi.
     *
     * @return int|null
     */
    protected function installSensApi()
    {

        // Migrations
        $this->components->info('Migration file copy to '.base_path('database/migrations'));
        
        (new Filesystem)->ensureDirectoryExists(base_path('database/migrations'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../database/migrations',base_path('database/migrations'));   

        $this->line('');
        $this->components->info('SensApi scaffolding installed successfully.');

    }
}