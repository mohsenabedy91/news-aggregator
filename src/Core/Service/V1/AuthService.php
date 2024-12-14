<?php

namespace Src\Core\Service\V1;

use Illuminate\Support\Facades\Hash;
use Src\Adapter\Storage\MySql\UserRepository\UserRepositoryInterface;
use Src\Core\Domain\UserEntity;
use Src\Core\Port\V1\AuthServiceInterface;

readonly class AuthService implements AuthServiceInterface
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function register(UserEntity $user): UserEntity
    {
        $user->setPassword(
            password: Hash::make(value: $user->getPassword()),
        );

        return $this->userRepository->create(user: $user);
    }
}
