<?php

namespace Src\Core\Port\V1;

use Src\Core\Domain\UserEntity;

interface AuthServiceInterface
{
    public function register(UserEntity $user): UserEntity;
}
