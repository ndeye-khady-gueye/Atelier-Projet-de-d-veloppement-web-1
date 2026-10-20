<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use nrv\api\errors\JsonErrorRenderer;
use nrv\api\middlewares\CorsMiddleware;
use Slim\Factory\AppFactory;

$builder = new ContainerBuilder();
$builder->addDefinitions(__DIR__ . '/settings.php');
$builder->addDefinitions(__DIR__ . '/dependencies.php');
$container = $builder->build();

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->add(CorsMiddleware::class);

$errorMiddleware = $app->addErrorMiddleware(
    (bool) $container->get('settings')['displayErrorDetails'],
    true,
    true
);
$errorHandler = $errorMiddleware->getDefaultErrorHandler();
$errorHandler->registerErrorRenderer('application/json', JsonErrorRenderer::class);
$errorHandler->forceContentType('application/json');

(require __DIR__ . '/routes.php')($app);

return $app;
