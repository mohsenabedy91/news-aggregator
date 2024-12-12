<?php

namespace Src\Adapter\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use OpenApi\Attributes as OA;
use Src\Adapter\Http\Requests\V1\RegisterRequest;
use Src\Core\Domain\Events\UserRegistered;
use Src\Core\Domain\UserEntity;
use Src\Core\Port\V1\AuthServiceInterface;
use Src\Core\Port\V1\OtpServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthServiceInterface $authService,
        private readonly OtpServiceInterface  $otpService
    )
    {
    }

    #[OA\Post(
        path: "/api/{language}/v1/auth/register",
        operationId: "post_api_language_v1_auth_register",
        summary: "It register a new user and return successful message then send an email to verify email.",
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                type: RegisterRequest::class,
            ),
        ),
        tags: ["Authentication"],
        parameters: [
            new OA\Parameter(
                name: "language",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "string"),
                example: "en",
            ),
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "success",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "message",
                            type: "string",
                            example: "The User was successfully registered.",
                        ),
                    ],
                ),
            ),
            new OA\Response(
                response: Response::HTTP_UNPROCESSABLE_ENTITY,
                description: "error",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "errors",
                            properties: [
                                new OA\Property(
                                    property: "first_name",
                                    type: "array",
                                    items: new OA\Items(
                                        type: "string",
                                        example: "The first name field must be at least 3 characters.",
                                    ),
                                ),
                                new OA\Property(
                                    property: "email",
                                    type: "array",
                                    items: new OA\Items(
                                        type: "string",
                                        example: "The email field must be a valid email address.",
                                    ),
                                ),
                            ],
                            type: "object",
                        ),
                    ],
                ),
            ),
        ]
    )]
    public function register(RegisterRequest $request)
    {
        $userRequest = UserEntity::fromArray($request->validated());
        $registeredUser = $this->authService->register($userRequest);

        $otp = $this->otpService->set($registeredUser->getEmail());

        UserRegistered::dispatch($registeredUser->getEmail(), $otp, $registeredUser->getFullName(), App::getLocale());

        return response()->json([
            "message" => Lang::get("messages.registered_user"),
        ]);
    }
}
