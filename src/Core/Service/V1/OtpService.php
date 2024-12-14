<?php

namespace Src\Core\Service\V1;

use Exception;
use Illuminate\Support\Facades\Log;
use Random\RandomException;
use Src\Adapter\Storage\Redis\AuthRepository\OTPRepositoryInterface;
use Src\Core\Domain\OTPEntity;
use Src\Core\Port\V1\OtpServiceInterface;
use Src\Core\Utils\OTPHelper;

readonly class OtpService implements OtpServiceInterface
{
    public function __construct(private OTPRepositoryInterface $OTPRepository)
    {
    }

    /**
     * @throws RandomException
     * @throws Exception
     */
    public function set(string $key): string
    {
        $otp = new OTPEntity();

        try {
            $otp->setValue(OTPHelper::generateRandom(config("otp.digits")));
        } catch (RandomException $e) {
            Log::error("Failed to generate OTP: " . $e->getMessage(), [
                "key" => $key,
                "exception" => $e,
            ]);
            throw new Exception("An error occurred while generating the OTP. Please try again.");
        }

        $this->OTPRepository->set($key, $otp);
        return $otp->getValue();
    }
}
