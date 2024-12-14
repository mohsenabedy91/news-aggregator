<?php

namespace Src\Adapter\Http\Transformers\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[OA\Schema(
    title: "LoginResource",
    properties: [
        new OA\Property(
            property: "data",
            properties: [
                new OA\Property(
                    property: "access_token",
                    type: "string",
                    example: "5|KelcjH6gIC6EIfEubs9nPMNCwpdVOFQrO47HqSfYfe8777e8",
                ),
            ],
        ),
    ],
    type: "object",
)]
class LoginResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "access_token" => $this->getAccessToken(),
        ];
    }

    public function toResponse($request): JsonResponse
    {
        return parent::toResponse($request)
            ->setStatusCode(Response::HTTP_OK);
    }
}
