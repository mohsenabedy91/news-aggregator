<?php

namespace Src\Core\Service;

use Illuminate\Support\Facades\Lang;
use Src\Core\Port\HealthServiceInterface;

class HealthService implements HealthServiceInterface
{
    /**
     * Return the health status message.
     *
     * @return string
     */
    public function getHealthStatus(): string
    {
        return Lang::get('messages.health_check');
    }
}
