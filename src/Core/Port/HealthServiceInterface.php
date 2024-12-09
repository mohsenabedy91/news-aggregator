<?php

namespace Src\Core\Port;

interface HealthServiceInterface
{
    public function getHealthStatus(): string;
}
