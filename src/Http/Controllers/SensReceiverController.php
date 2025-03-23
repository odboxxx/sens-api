<?php

declare(strict_types=1);

namespace Odboxxx\SensApi\Http\Controllers;

use Illuminate\Http\JsonResponse;

use Odboxxx\SensApi\Http\Requests\SensReceiverRequest;
use Odboxxx\SensApi\Http\Requests\SpaRequest;
use Odboxxx\SensApi\Services\SensService;


class SensReceiverController
{

    /**
     * Запрос данных датчиков от SPA
     *
     * @param  \Odboxxx\SensApi\Http\Requests\SpaRequest  $request
     * @return \Illuminate\Http\JsonResponse;
     */
    public function get(SpaRequest $request): JsonResponse
    {
        return response()->json(
            SensService::sensorsReadingsGet(
                $request->sensors,
                $request->sdate,
                $request->edate
            )
        );
    }

    /**
     * Принимаем данные датчиков
     *
     * @param  \Odboxxx\SensApi\Http\Requests\SensorsReceiverRequest  $request
     * @return \Illuminate\Http\JsonResponse;
     */
    public function set(SensReceiverRequest $request): JsonResponse
    {

        $recordId = SensService::sensorRecord(
            $request->sensor,
            $request->svalue
        );


        return response()->json([
            'result' => (int)$recordId
        ]);

    }
}
