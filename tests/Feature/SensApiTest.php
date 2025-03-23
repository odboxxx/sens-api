<?php

namespace Odboxxx\SensApi\Tests\Feature;

use Odboxxx\SensApi\Models\SensorsReadings;
use Odboxxx\SensApi\Tests\TestCase;

class SensApiTest extends TestCase
{
    /**
     * Запрос данных полученных от датчиков
     */
    public function test_sensapi_get(): void
    {
        SensorsReadings::factory()->count(100)->create();

        $params = [
            'sensors' => [1,2,3],
            'sdate' => time()-1000,
            'edate' => time(),
        ];
     
        $response = $this->get('/api/spa?'.http_build_query($params));

        $response->assertValid();
        $response->assertJsonStructure(['cases_quant_total']);
    }
    /**
     * Передача данных датчиками
     */
    public function test_sensapi_set(): void
    {
        $sensorsVars = [
            1 => 'T',
            2 => 'P',
            3 => 'v'
        ];

        $params['sensor'] = rand(1,3);
        $params[
            $sensorsVars[
                $params['sensor']
            ]
        ] = rand(0,100);


        $response = $this->get('/api?'.http_build_query($params));
 
        $response->assertValid(['sensor']);
    }  

}
