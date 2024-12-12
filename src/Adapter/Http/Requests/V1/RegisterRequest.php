<?php

namespace Src\Adapter\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "RegisterRequest",
    properties: [
        new OA\Property(
            property: "first_name",
            description: "This property convert first character to upper other characters to lower.",
            type: "string",
            maximum: 100,
            minimum: 3,
            example: "Mohsen",
            nullable: false,
        ),
        new OA\Property(
            property: "last_name",
            description: "This property convert first character to upper other characters to lower.",
            type: "string",
            maximum: 100,
            minimum: 3,
            example: "Abedy",
            nullable: false,
        ),
        new OA\Property(
            property: "email",
            type: "email",
            example: "mohsenabedy1991@gmail.com",
            nullable: false,
        ),
        new OA\Property(
            property: "password",
            description: "This property should contains minimum 8 characters and at least one of both upper and lower case letters, number, symbol and is not in a known data breach.",
            type: "string",
            example: "Mohsen!123",
            nullable: false,
        ),
        new OA\Property(
            property: "password_confirmation",
            type: "string",
            example: "Mohsen!123",
            nullable: false,
        ),
    ],
    type: "object",
)]
class RegisterRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        return $this->merge([
            'first_name' => ucfirst(strtolower($this->input('first_name'))),
            'last_name' => ucfirst(strtolower($this->input('last_name'))),
        ]);
    }

    public function rules(): array
    {
        return [
            "first_name" => "bail|required|string|min:3|max:100",
            "last_name" => "bail|required|string|min:3|max:100",
            "email" => "bail|required|email|unique:users,email",
            "password" => [
                "bail",
                "required",
                "confirmed",
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ];
    }
}
