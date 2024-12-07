<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Adapter\CLI\Commands\GenerateSwagger;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register CLI Commands
        $this->commands([
            GenerateSwagger::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
