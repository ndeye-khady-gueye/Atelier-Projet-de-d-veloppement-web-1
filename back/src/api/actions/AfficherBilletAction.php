<?php
declare(strict_types=1);

namespace nrv\api\actions;

use nrv\api\representations\Representation;
use nrv\core\application\ports\api\ServiceCommandeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/** GET /billets/{token} : billet non nominatif, accessible par son lien (fonctionnalité 10) */
class AfficherBilletAction extends AbstractAction
{
    public function __construct(private ServiceCommandeInterface $serviceCommande)
    {
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        return $this->json($rs, Representation::billet($this->serviceCommande->billet($args['token'])));
    }
}
