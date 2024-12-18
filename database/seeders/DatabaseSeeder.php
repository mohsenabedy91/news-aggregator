<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Src\Adapter\Storage\MySql\UserRepository\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            "name" => "Test User",
            "email" => "test@example.com",
        ]);
    }
}
