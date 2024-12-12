<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Src\Adapter\CLI\Commands\GenerateSwagger;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register CLI Commands
        $this->commands([
            GenerateSwagger::class,
        ]);
    }

    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        RateLimiter::for("api", function (Request $request) {
            return Limit::perMinute(config("app.attempts_per_minute_limit"))->by($request->user()?->id ?: $request->ip());
        });
    }
}
