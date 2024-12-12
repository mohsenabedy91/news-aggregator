<?php

namespace Src\Adapter\Storage\MySql\UserRepository;

use Illuminate\Support\Facades\DB;
use Src\Core\Domain\UserEntity;

class UserRepository implements UserRepositoryInterface
{
    public function create(UserEntity $user): UserEntity
    {
        $id = DB::table("users")->insertGetId([
            "first_name" => $user->getFirstName(),
            "last_name" => $user->getLastName(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        $user->setId($id);

        return $user;
    }
}
