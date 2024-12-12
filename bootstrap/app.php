<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . "/../routes/api.php",
        health: "/up",
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(SetLocale::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->dontFlash([
            "password",
            "password_confirmation",
        ]);
    })->withEvents(discover: [
        __DIR__ . "/../src/Core/Service/Listeners",
    ])->create();
