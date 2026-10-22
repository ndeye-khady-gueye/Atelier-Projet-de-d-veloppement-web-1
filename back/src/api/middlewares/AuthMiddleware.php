<?php
declare(strict_types=1);

namespace nrv\api\middlewares;

use nrv\core\application\exceptions\ServiceAuthException;
use nrv\core\application\ports\api\ServiceAuthentificationInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpUnauthorizedException;

/**
 * Routes protégées : exige « Authorization: Bearer <jeton> » et place l'utilisateur connecté
 * (UtilisateurConnecteDTO) dans l'attribut « utilisateur » de la requête.
 */
class AuthMiddleware implements MiddlewareInterface
{
    public function __construct(private ServiceAuthentificationInterface $serviceAuth)
    {
    }

    public function process(ServerRequestInterface $rq, RequestHandlerInterface $handler): ResponseInterface
    {
        $entete = $rq->getHeaderLine('Authorization');
        if (!preg_match('/^Bearer\s+(\S+)$/i', $entete, $m)) {
            throw new HttpUnauthorizedException($rq, 'Authentification requise');
        }
        try {
            $utilisateur = $this->serviceAuth->verifierToken($m[1]);
        } catch (ServiceAuthException $e) {
            throw new HttpUnauthorizedException($rq, $e->getMessage());
        }
        return $handler->handle($rq->withAttribute('utilisateur', $utilisateur));
    }
}
