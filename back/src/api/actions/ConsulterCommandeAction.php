<?php
declare(strict_types=1);

namespace nrv\api\actions;

use nrv\api\representations\Representation;
use nrv\core\application\ports\api\ServiceCommandeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/** GET /commandes/{id} : commande et ses billets (si payée) */
class ConsulterCommandeAction extends AbstractAction
{
    public function __construct(private ServiceCommandeInterface $serviceCommande)
    {
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $commande = $this->serviceCommande->consulter($this->utilisateur($rq)->id, (int) $args['id']);
        return $this->json($rs, Representation::commande($commande));
    }
}
