<?php

use Odboxxx\SensApi\Http\Controllers\SensReceiverController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {

    Route::get('/api/spa', [SensReceiverController::class, 'get']);
    Route::get('/api', [SensReceiverController::class, 'set']);

});