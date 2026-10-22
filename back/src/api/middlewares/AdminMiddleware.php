<?php
declare(strict_types=1);

namespace nrv\api\middlewares;

use nrv\core\application\dto\UtilisateurConnecteDTO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpForbiddenException;

/** Back-office : réservé aux gestionnaires (à placer après AuthMiddleware). */
class AdminMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $rq, RequestHandlerInterface $handler): ResponseInterface
    {
        $u = $rq->getAttribute('utilisateur');
        if (!$u instanceof UtilisateurConnecteDTO || !$u->estAdmin()) {
            throw new HttpForbiddenException($rq, 'Accès réservé aux gestionnaires du festival');
        }
        return $handler->handle($rq);
    }
}
