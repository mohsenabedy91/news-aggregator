<?php

namespace Src\Adapter\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "VerifyRequest",
    properties: [
        new OA\Property(
            property: "email",
            type: "email",
            example: "mohsenabedy1991@gmail.com",
            nullable: false,
        ),
        new OA\Property(
            property: "token",
            type: "numeric",
            example: "0958",
            nullable: false,
        ),
    ],
    type: "object",
)]
class VerifyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email" => "bail|required|email|exists:users,email",
            "token" => "bail|required|numeric",
        ];
    }
}
