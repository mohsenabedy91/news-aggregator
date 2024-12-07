<?php

use Illuminate\Support\Facades\Route;
use Src\Adapter\Http\Controllers\HealthCheckController;

Route::group(['prefix' => '/{locale}'], function () {
    Route::group(['prefix' => '/v1'], function () {
        Route::get('/health-check', [HealthCheckController::class, 'check']);
    });
});
