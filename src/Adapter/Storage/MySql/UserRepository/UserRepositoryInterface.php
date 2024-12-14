<?php

namespace Src\Adapter\Storage\MySql\UserRepository;

use Src\Core\Domain\UserEntity;

interface UserRepositoryInterface
{
    public function create(UserEntity $user): UserEntity;
}