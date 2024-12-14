<?php

namespace Src\Adapter\Storage\MySql\UserRepository;

use Illuminate\Support\Facades\DB;
use Src\Core\Domain\UserEntity;

class UserRepository implements UserRepositoryInterface
{
    public function create(UserEntity $user): UserEntity
    {
        $id = DB::table(table: "users")->insertGetId(values: [
            "first_name" => $user->getFirstName(),
            "last_name" => $user->getLastName(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        $user->setId(id: $id);

        return $user;
    }

    public function getByEmail(string $email): ?User
    {
        return User::query()
            ->where(column: "email", operator: "=", value: $email)
            ->first();
    }

    public function updateEmailVerified(int $Id): void
    {
        User::query()
            ->where(column: "id", operator: "=", value: $Id)
            ->update(values: ["email_verified_at" => now()]);
    }
}
