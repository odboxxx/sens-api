<?php

namespace Odboxxx\SensApi\Models;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Odboxxx\SensApi\Database\Factories\SensorsReadingsFactory;

/**
 * @property int $id
 * @property int $sensor_id
 * @property int $value
 * @property int $created_at
 */

class SensorsReadings extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    //protected $table = 'sensors_readings';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sensor_id',
        'value',
        'created_at'
    ];

    /**
     * Create a new factory instance for the model.
     */
    
    protected static function newFactory(): Factory
    {
        return SensorsReadingsFactory::new();
    }
    
}
