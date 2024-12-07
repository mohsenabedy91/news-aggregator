<?php

namespace Src\Core\Port;

interface HealthServiceInterface
{
    /**
     * Return the health status message.
     *
     * @return string
     */
    public function getHealthStatus(): string;
}
