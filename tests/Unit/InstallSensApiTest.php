<?php

namespace Odboxxx\SensApi\Tests\Unit;

use Illuminate\Support\Facades\Artisan;

use Odboxxx\SensApi\Tests\TestCase;

class InstallSensApiTest extends TestCase
{
    /** @test */
    function the_install_command()
    {

        Artisan::call('sensapi:install');
        $this->assertTrue(true);
    }
}