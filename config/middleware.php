<?php
declare(strict_types=1);
use App\Shared\Middleware\AuthValidateTokenMiddleware;
use Slim\App;

return function (App $app) {
    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });
    $app->add(\App\Shared\Middleware\CorsMiddleware::class);
    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();
};