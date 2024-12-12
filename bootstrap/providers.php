<?php

use App\Providers\AppServiceProvider;
use App\Providers\HealthCheckServiceProvider;
use App\Providers\UserServiceProvider;

return [
    AppServiceProvider::class,
    HealthCheckServiceProvider::class,
    UserServiceProvider::class,
];
