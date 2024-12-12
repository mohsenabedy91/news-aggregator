<?php

return [
    "expire_second" => env("OTP_EXPIRE_SECOND", 180),
    "digits" => env("OTP_DIGITS", 4),
];
