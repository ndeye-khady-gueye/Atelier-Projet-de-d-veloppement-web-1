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

$errorMiddleware = $app->addErrorMiddleware(
    (bool) $container->get('settings')['displayErrorDetails'],
    true,
    true
);
$errorHandler = $errorMiddleware->getDefaultErrorHandler();
$errorHandler->registerErrorRenderer('application/json', JsonErrorRenderer::class);
$errorHandler->forceContentType('application/json');

// Ajouté en dernier = exécuté en premier : les en-têtes CORS sont aussi posés
// sur les réponses d'erreur (404, 400, 500) produites par le middleware d'erreurs.
$app->add(CorsMiddleware::class);

(require __DIR__ . '/routes.php')($app);

return $app;
