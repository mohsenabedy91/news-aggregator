<?php

namespace Src\Adapter\Storage\Redis\AuthRepository;

use Src\Core\Domain\OTPEntity;

interface OTPRepositoryInterface
{
    public function set(string $key, OTPEntity $value);

    public function get(string $key): OTPEntity;
}
