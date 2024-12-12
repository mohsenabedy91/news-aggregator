<?php

namespace Src\Core\Port\V1;

interface OtpServiceInterface
{
    public function set(string $key): string;
}
