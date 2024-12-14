<?php

namespace Src\Adapter\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use OpenApi\Attributes as OA;
use Src\Adapter\Http\Requests\V1\RegisterRequest;
use Src\Adapter\Http\Requests\V1\VerifyRequest;
use Src\Adapter\Http\Transformers\V1\LoginResource;
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
                response: Response::HTTP_CREATED,
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
    public function register(RegisterRequest $request): JsonResponse
    {
        $userRequest = UserEntity::fromArray(data: $request->validated());
        $registeredUser = $this->authService->register(user: $userRequest);

        $otp = $this->otpService->set(key: $registeredUser->getEmail());

        UserRegistered::dispatch($registeredUser->getEmail(), $otp, $registeredUser->getFullName(), App::getLocale());

        return response()->json(
            data: [
                "message" => Lang::get(key: "messages.registered_user"),
            ],
            status: Response::HTTP_CREATED,
        );
    }

    #[OA\Post(
        path: "/api/{language}/v1/auth/verify-email",
        operationId: "post_api_language_v1_auth_verify_email",
        summary: "It verify your email address, after registration you should verify your email address, if you've verified successfully you'll be able to login.",
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                type: VerifyRequest::class,
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
                    type: LoginResource::class,
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
                                    property: "email",
                                    type: "array",
                                    items: new OA\Items(
                                        type: "string",
                                        example: "The email field must be a valid email address.",
                                    ),
                                ),
                                new OA\Property(
                                    property: "token",
                                    type: "array",
                                    items: new OA\Items(
                                        type: "string",
                                        example: "The token field must be a number.",
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
    public function verifyEmail(VerifyRequest $request): JsonResponse
    {
        $req = $request->validated();
        $accessToken = $this->authService->verifyEmail(email: $req["email"], token: $req["token"]);

        return (new LoginResource(resource: $accessToken))->response();
    }
}
