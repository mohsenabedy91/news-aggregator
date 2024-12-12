<?php

namespace Src\Adapter\Storage\Redis\AuthRepository;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Src\Core\Constants\CacheConstant;
use Src\Core\Domain\OTPEntity;

class OTPRepository implements OTPRepositoryInterface
{
    /**
     * @throws Exception
     */
    public function set(string $key, OTPEntity $value): void
    {
        $redisKey = CacheConstant::RedisOTPPrefix . ":" . $key;
        $expireSeconds = (int)config("otp.expire_second");

        if ($expireSeconds <= 0) {
            Log::warning("Invalid OTP expiration time configured", [
                "key" => $key,
                "expire_seconds" => $expireSeconds,
            ]);
            throw new Exception("Invalid OTP expiration time configured.");
        }

        try {
            $serializedValue = json_encode($value->toArray());
            if ($serializedValue === false) {
                throw new Exception("Failed to serialize OTP value.");
            }

            Cache::put($redisKey, $serializedValue, $expireSeconds);
        } catch (Exception $e) {
            Log::error("Failed to save OTP in Redis: " . $e->getMessage(), [
                "key" => $key,
                "value" => $value->toArray(),
                "exception" => $e,
            ]);
            throw new Exception("Failed to save OTP. Please try again.");
        }
    }
}
