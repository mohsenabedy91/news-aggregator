<?php

namespace Src\Adapter\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use Src\Core\Port\HealthServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckController extends Controller
{
    private HealthServiceInterface $healthCheckUseCase;

    public function __construct(HealthServiceInterface $healthCheckUseCase)
    {
        $this->healthCheckUseCase = $healthCheckUseCase;
    }

    #[OA\Get(
        path: "/api/{language}/v1/health-check",
        operationId: "get_api_language_v1_health_check",
        summary: "Returns the service status in multiple languages.",
        tags: ["Health check"],
        parameters: [
            new OA\Parameter(
                name: "language",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "string"),
                example: "en"
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
                            example: "I'm working"
                        ),
                    ],
                ),
            ),
        ]
    )]
    public function check(): JsonResponse
    {
        $message = $this->healthCheckUseCase->getHealthStatus();

        return response()->json([
            "message" => $message,
        ]);
    }
}
