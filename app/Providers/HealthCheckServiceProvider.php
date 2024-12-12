<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Core\Port\HealthServiceInterface;
use Src\Core\Service\HealthService;

class HealthCheckServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(HealthServiceInterface::class, HealthService::class);
    }

    public function boot(): void
    {
        //
    }
}

