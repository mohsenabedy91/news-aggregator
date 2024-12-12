<?php

namespace Src\Core\Utils;

use Illuminate\Support\Facades\Log;
use Random\RandomException;

class OTPHelper
{
    /**
     * @throws RandomException
     */
    public static function generateRandom(int $length = 4): string
    {
        try {
            return str_pad(random_int(0, (10 ** $length) - 1), $length, '0', STR_PAD_LEFT);
        } catch (RandomException $e) {
            Log::error("Random number generation failed: " . $e->getMessage(), [
                "length" => $length,
                "exception" => $e,
            ]);
            throw $e;
        }
    }
}
