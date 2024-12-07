<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

define("API_HOST", config("swagger.variables.host"));

#[
    OA\Info(
        version: '1.0.0',
        title: 'News Aggregator'
    ),
    OA\Server(
        url: API_HOST,
        description: "News Aggregator API"
    ),
    OA\SecurityScheme(
        securityScheme: 'bearerAuth',
        type: 'http',
        name: 'bearerAuth',
        in: 'header',
        bearerFormat: 'JWT',
        scheme: 'bearer',
    )
]
abstract class Controller
{
    //
}
