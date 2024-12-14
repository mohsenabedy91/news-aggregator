<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpFoundation\Response;

class InvalidOTPException extends Exception
{
    public function __construct()
    {
        $message = Lang::get(key: 'error.otp.is_invalid');

        parent::__construct(message: $message, code: Response::HTTP_UNAUTHORIZED);
    }
}
