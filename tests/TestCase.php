<?php

namespace Odboxxx\SensApi\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use Odboxxx\SensApi\SensApiServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase 
{
    use DatabaseMigrations;

    public function setUp(): void
    {
      parent::setUp();
      
      $this->withoutExceptionHandling();
      $this->setUpDatabase();

    }

    protected function getPackageProviders($app)
    {
        return [
            SensApiServiceProvider::class,
        ];
    }

    protected function setUpDatabase()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/2025_03_22_153837_create_sensors.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/2025_03_22_153837_create_sensors_readings.php');     
    }        

}