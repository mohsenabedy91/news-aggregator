<?php

namespace Src\Core\Port\V1;

use Src\Adapter\Storage\MySql\UserRepository\User;
use Src\Core\Domain\UserEntity;

interface AuthServiceInterface
{
    public function register(UserEntity $user): UserEntity;

    public function verifyEmail(string $email, string $token): UserEntity;

    public function generateAuthToken(User $user): string;
}
