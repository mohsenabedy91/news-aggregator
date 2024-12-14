<?php

namespace Src\Core\Service\V1;

use App\Exceptions\InvalidOTPException;
use App\Exceptions\UserNotFoundException;
use Illuminate\Support\Facades\Hash;
use Src\Adapter\Storage\MySql\UserRepository\User;
use Src\Adapter\Storage\MySql\UserRepository\UserRepositoryInterface;
use Src\Adapter\Storage\Redis\AuthRepository\OTPRepositoryInterface;
use Src\Core\Domain\UserEntity;
use Src\Core\Port\V1\AuthServiceInterface;

readonly class AuthService implements AuthServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private OTPRepositoryInterface  $OTPRepository,
    )
    {
    }

    public function register(UserEntity $user): UserEntity
    {
        $user->setPassword(
            password: Hash::make(value: $user->getPassword()),
        );

        return $this->userRepository->create(user: $user);
    }

    /**
     * @throws InvalidOTPException
     * @throws UserNotFoundException
     */
    public function verifyEmail(string $email, string $token): UserEntity
    {
        $user = $this->userRepository->getByEmail(email: $email);
        if (!$user) {
            throw new UserNotFoundException(email: $email);
        }

        $otp = $this->OTPRepository->get(key: $email);
        if ($otp->getValue() !== $token) {
            throw new InvalidOTPException();
        }

        $this->userRepository->updateEmailVerified(id: $user->id);

        $authToken = $this->generateAuthToken(user: $user);

        return new UserEntity(
            id: $user->id,
            firstName: $user->first_name,
            lastName: $user->last_name,
            email: $user->email,
            accessToken: $authToken,
        );
    }

    public function generateAuthToken(User $user): string
    {
        return $user->createToken(name: "auth_token")->plainTextToken;
    }
}
