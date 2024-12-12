<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Adapter\Storage\MySql\UserRepository\UserRepository;
use Src\Adapter\Storage\MySql\UserRepository\UserRepositoryInterface;
use Src\Adapter\Storage\Redis\AuthRepository\OTPRepository;
use Src\Adapter\Storage\Redis\AuthRepository\OTPRepositoryInterface;
use Src\Core\Port\V1\AuthServiceInterface;
use Src\Core\Port\V1\OtpServiceInterface;
use Src\Core\Service\V1\AuthService;
use Src\Core\Service\V1\OtpService;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OtpServiceInterface::class, OtpService::class);
        $this->app->bind(OTPRepositoryInterface::class, OTPRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
