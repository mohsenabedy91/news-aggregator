<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class CustomException extends ExceptionHandler
{
    public function render($request, Throwable $e): Response
    {
        if ($request->is("api/*") || $request->expectsJson() || $request->wantsJson()) {
            if ($e instanceof ValidationException) {
                return response()->json(
                    [
                        "errors" => $e->validator->errors(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_UNPROCESSABLE_ENTITY),
                );
            }

            return response()->json(
                data: [
                    "message" => $e->getMessage(),
                ],
                status: $this->getStatusCode(e: $e, statusCode: Response::HTTP_BAD_REQUEST),
            );
        }

        return parent::render(request: $request, e: $e);
    }

    private function getStatusCode(Throwable $e, int $statusCode): int
    {
        return $e->getCode() &&
        $e->getCode() < Response::HTTP_SERVICE_UNAVAILABLE &&
        $e->getCode() > Response::HTTP_MULTIPLE_CHOICES
            ? $e->getCode()
            : $statusCode;
    }
}
