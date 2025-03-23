<?php

namespace Odboxxx\SensApi\Database\Factories;
 
use Illuminate\Database\Eloquent\Factories\Factory;
use Odboxxx\SensApi\Models\SensorsReadings;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Odboxxx\SensApi\Models\SensorsReadings>
 */
class SensorsReadingsFactory extends Factory
{
 
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = SensorsReadings::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sensor_id' => rand(1,3),
            'value' => rand(0,50),
            'created_at' => rand(time()-500,time()),
        ];
    }
 
}