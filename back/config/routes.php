<?php
declare(strict_types=1);

use nrv\api\actions\AfficherBilletAction;
use nrv\api\actions\AfficherSoireeAction;
use nrv\api\actions\AjouterAuPanierAction;
use nrv\api\actions\AjouterPassAction;
use nrv\api\actions\ConnexionAction;
use nrv\api\actions\ConsulterCommandeAction;
use nrv\api\actions\ConsulterPanierAction;
use nrv\api\actions\HomeAction;
use nrv\api\actions\InscriptionAction;
use nrv\api\actions\ListerJaugesAction;
use nrv\api\actions\ListerSpectaclesAction;
use nrv\api\actions\ListerStylesAction;
use nrv\api\actions\ModifierLignePanierAction;
use nrv\api\actions\PayerCommandeAction;
use nrv\api\actions\SupprimerLignePanierAction;
use nrv\api\actions\ValiderPanierAction;
use nrv\api\middlewares\AdminMiddleware;
use nrv\api\middlewares\AuthMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app): void {
    $app->get('/', HomeAction::class)->setName('home');

    // programme du festival (fonctionnalités 1 à 5) : public
    $app->get('/spectacles', ListerSpectaclesAction::class)->setName('spectacles');
    $app->get('/styles', ListerStylesAction::class)->setName('styles');
    $app->get('/soirees/{id:[0-9]+}', AfficherSoireeAction::class)->setName('soiree');

    // comptes
    $app->post('/auth/register', InscriptionAction::class)->setName('inscription');
    $app->post('/auth/signin', ConnexionAction::class)->setName('connexion');

    // billet : public, accessible par son token aléatoire (non nominatif)
    $app->get('/billets/{token:[0-9a-f]{64}}', AfficherBilletAction::class)->setName('billet');

    // achat (fonctionnalités 6 à 10) : utilisateur connecté
    $app->group('', function (RouteCollectorProxy $g) {
        $g->get('/panier', ConsulterPanierAction::class)->setName('panier');
        $g->post('/panier/lignes', AjouterAuPanierAction::class);
        $g->post('/panier/pass', AjouterPassAction::class);
        $g->patch('/panier/lignes/{id:[0-9]+}', ModifierLignePanierAction::class);
        $g->delete('/panier/lignes/{id:[0-9]+}', SupprimerLignePanierAction::class);
        $g->post('/panier/valider', ValiderPanierAction::class);
        $g->get('/commandes/{id:[0-9]+}', ConsulterCommandeAction::class)->setName('commande');
        $g->post('/commandes/{id:[0-9]+}/paiement', PayerCommandeAction::class);
    })->add(AuthMiddleware::class);

    // back-office (fonctionnalité 11) : gestionnaires uniquement
    $app->group('/admin', function (RouteCollectorProxy $g) {
        $g->get('/soirees', ListerJaugesAction::class)->setName('jauges');
    })->add(AdminMiddleware::class)->add(AuthMiddleware::class);

    // pré-requête CORS
    $app->options('/{routes:.+}', fn (ServerRequestInterface $rq, ResponseInterface $rs) => $rs);
};
