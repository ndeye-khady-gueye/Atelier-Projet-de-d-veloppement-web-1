<?php
declare(strict_types=1);

use nrv\api\actions\AfficherSoireeAction;
use nrv\api\actions\HomeAction;
use nrv\api\actions\ListerSpectaclesAction;
use nrv\api\actions\ListerStylesAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app): void {
    $app->get('/', HomeAction::class)->setName('home');

    // programme du festival (fonctionnalités 1 à 5)
    $app->get('/spectacles', ListerSpectaclesAction::class)->setName('spectacles');
    $app->get('/styles', ListerStylesAction::class)->setName('styles');
    $app->get('/soirees/{id:[0-9]+}', AfficherSoireeAction::class)->setName('soiree');

    // pré-requête CORS
    $app->options('/{routes:.+}', fn (ServerRequestInterface $rq, ResponseInterface $rs) => $rs);
};
