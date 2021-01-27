<?php declare(strict_types=1);

use App\Shared\Handlers\HttpErrorHandler;
use App\Shared\Handlers\ShutdownHandler;
use App\Shared\Responder\ResponseEmitter;
use DI\ContainerBuilder;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Factory\ServerRequestCreatorFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

// Set up dependencies
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

// Build PHP-DI Container instance
try {
    $container = $containerBuilder->build();
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}

// Create App instance
try {
    // Instantiate the app
    $app = $container->get(App::class);
    $callableResolver = $app->getCallableResolver();
    $displayErrorDetails = false;

    // Register Middleware
    (require __DIR__ . '/middleware.php')($app);

    // Register Routes
    (require __DIR__ . '/routes.php')($app);

    // Create Request object from globals
    $serverRequestCreator = ServerRequestCreatorFactory::create();
    $request = $serverRequestCreator->createServerRequestFromGlobals();

    // Create Error Handler
    $responseFactory = $app->getResponseFactory();
    $errorHandler = new HttpErrorHandler($callableResolver, $responseFactory, $container->get(LoggerInterface::class));

    // Create Shutdown Handler
    $shutdownHandler = new ShutdownHandler($request, $errorHandler, $displayErrorDetails);
    register_shutdown_function($shutdownHandler);

    // Add Routing Middleware
    $app->addRoutingMiddleware();

    // Add Error Middleware
    $errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, false, false);
    $errorMiddleware->setDefaultErrorHandler($errorHandler);

    // Run App & Emit Response
    $response = $app->handle($request);
    $responseEmitter = new ResponseEmitter();
    $responseEmitter->emit($response);

//    return $app;

} catch (\DI\DependencyException $e) {
    throw new Exception($e->getMessage());
} catch (\DI\NotFoundException $e) {
    throw new Exception($e->getMessage());
}

