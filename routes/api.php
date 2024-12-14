<?php

use Illuminate\Support\Facades\Route;
use Src\Adapter\Http\Controllers\HealthCheckController;
use Src\Adapter\Http\Controllers\V1\AuthController;

Route::group(["prefix" => "/{locale}"], function () {
    Route::group(["prefix" => "/v1"], function () {
        Route::get("/health-check", [HealthCheckController::class, "check"]);

        Route::group(["prefix" => "/auth"], function () {
            Route::post("/register", [AuthController::class, "register"])->name("v1.auth.register");
            Route::post("/verify-email", [AuthController::class, "verifyEmail"])->name("v1.auth.verifyEmail");
        });
    });
});
