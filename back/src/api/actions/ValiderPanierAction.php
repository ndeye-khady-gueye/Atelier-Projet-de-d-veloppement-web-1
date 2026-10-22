<?php
declare(strict_types=1);

namespace nrv\api\actions;

use nrv\api\representations\Representation;
use nrv\core\application\ports\api\ServicePanierInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/** POST /panier/valider : le panier devient une commande (fonctionnalité 8) */
class ValiderPanierAction extends AbstractAction
{
    public function __construct(private ServicePanierInterface $servicePanier)
    {
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $commande = $this->servicePanier->valider($this->utilisateur($rq)->id);
        return $this->json($rs, Representation::commande($commande), 201)
            ->withHeader('Location', '/commandes/' . $commande->id);
    }
}
