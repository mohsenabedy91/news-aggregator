<?php

namespace Src\Core\Service;

use Illuminate\Support\Facades\Lang;
use Src\Core\Port\HealthServiceInterface;

class HealthService implements HealthServiceInterface
{
    public function getHealthStatus(): string
    {
        return Lang::get('messages.health_check');
    }
}
