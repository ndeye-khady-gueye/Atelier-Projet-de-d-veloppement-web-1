<?php
declare(strict_types=1);

namespace nrv\api\actions;

use Psr\Http\Message\ResponseInterface;
use nrv\core\application\dto\UtilisateurConnecteDTO;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractAction
{
    abstract public function __invoke(
        ServerRequestInterface $rq,
        ResponseInterface $rs,
        array $args
    ): ResponseInterface;

    protected function json(ResponseInterface $rs, array $data, int $status = 200): ResponseInterface
    {
        $rs->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        return $rs->withHeader('Content-Type', 'application/json')->withStatus($status);
    }

    /** Utilisateur placé dans la requête par AuthMiddleware. */
    protected function utilisateur(ServerRequestInterface $rq): UtilisateurConnecteDTO
    {
        return $rq->getAttribute('utilisateur');
    }

    /** Corps JSON de la requête (tableau vide si absent ou invalide). */
    protected function corps(ServerRequestInterface $rq): array
    {
        $corps = $rq->getParsedBody();
        return is_array($corps) ? $corps : [];
    }
}
