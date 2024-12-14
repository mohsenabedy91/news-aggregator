<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpFoundation\Response;

class UserNotFoundException extends Exception
{
    public function __construct(string $email)
    {
        $message = Lang::get(key: "error.user.not_found", replace: ["email" => $email]);

        parent::__construct(message: $message, code: Response::HTTP_NOT_FOUND);
    }
}
