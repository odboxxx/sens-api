<?php

declare(strict_types=1);

namespace Odboxxx\SensApi\Services;

use Odboxxx\SensApi\Models\SensorsReadings;

class SensService
{   
    /**
     * Запись показания датчика
     *
     * @param int $sensorId
     * @param float $value
     *
     * @return int|null recordId
     */      
    public static function sensorRecord(int $sensorId, float $value): int|null
    {
        
        return SensorsReadings::create([
            'sensor_id' => $sensorId,
            'value' => $value
        ])->id;
 
    }

    /**
     * Формат данных для ответа на запрос SPA
     *
     * @param Collection<SensorsReadings> $sensorsReadings
     *
     * @return array
     */      
    public static function sensorsReadingsToSpaRequest(object $sensorsReadings): array
    {
        $j['cases_quant_total'] = $sensorsReadings->count();
        $sensNumber = 0;

        if ($j['cases_quant_total'] > 0) {
   
            foreach ($sensorsReadings as $case) {
                
                if (!isset($seq[$case->sensor_id])) {
                    $seq[$case->sensor_id] = $sensNumber;
                    $sensNumber++;
                    $j['data'][$seq[$case->sensor_id]]['sensor_id'] = $case->sensor_id;
                    $j['data'][$seq[$case->sensor_id]]['cases_quant'] = 0;
                }

                $j['data'][$seq[$case->sensor_id]]['cases_quant']++;
                $j['data'][$seq[$case->sensor_id]]['cases'][] = [
                    'value' => $case->value,
                    'time' => strtotime($case->created_at),
                ];
                
            }
        }

        return $j;
    }

    /**
     * Выборка показаний счётчиков
     *
     * @param int[] $sensorsIds
     * @param int $timeFrom
     * @param int $timeTo
     *
     * @return array
     */      
    public static function sensorsReadingsGet(array $sensorsIds, int $timeFrom, int $timeTo): array
    {
        $sensorsReadings = SensorsReadings::whereIn('sensor_id', $sensorsIds)
        ->where('created_at', '>=', 
            date("Y-m-d H:i:s", $timeFrom)
        )
        ->where('created_at', '<=', 
            date("Y-m-d H:i:s", $timeTo)
        )
        ->get();

        return self::sensorsReadingsToSpaRequest($sensorsReadings);

    }

}
