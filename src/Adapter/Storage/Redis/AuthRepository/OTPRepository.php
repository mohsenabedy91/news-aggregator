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
        $expireSeconds = (int)config(key: "otp.expire_second");

        if ($expireSeconds <= 0) {
            Log::warning("Invalid OTP expiration time configured", [
                "key" => $key,
                "expire_seconds" => $expireSeconds,
            ]);
            throw new Exception(message: "Invalid OTP expiration time configured.");
        }

        try {
            $serializedValue = json_encode(value: $value->toArray());
            if ($serializedValue === false) {
                throw new Exception(message: "Failed to serialize OTP value.");
            }

            Cache::put(key: $redisKey, value: $serializedValue, ttl: $expireSeconds);
        } catch (Exception $e) {
            Log::error(
                message: "Failed to save OTP in Redis: " . $e->getMessage(),
                context: [
                    "key" => $key,
                    "value" => $value->toArray(),
                    "exception" => $e,
                ],
            );
            throw new Exception(message: "Failed to save OTP. Please try again.");
        }
    }

    /**
     * @throws Exception
     */
    public function get(string $key): OTPEntity
    {
        $redisKey = CacheConstant::RedisOTPPrefix . ":" . $key;
        try {
            $data = Cache::get(key: $redisKey);
            if ($data === null) {
                throw new Exception(message: "The One-Time Password (OTP) has expired. Please request a new OTP to continue.");
            }
        } catch (Exception $e) {
            Log::error(message: "Failed to get OTP from Cache: " . $e->getMessage());
            throw new Exception(message: "Failed to get OTP from Cache. Please try again.");
        }

        $data = json_decode(json: $data, associative: true);

        return new OTPEntity(
            value: $data["value"],
            used: $data["used"],
            requestCount: $data["requestCount"],
            createdAt: Carbon::createFromTimestamp($data["createdAt"]),
            lastRequest: Carbon::createFromTimestamp($data["lastRequest"]),
        );
    }
}
