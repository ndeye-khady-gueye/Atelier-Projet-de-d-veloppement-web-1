<?php
declare(strict_types=1);

namespace nrv\api\actions;

use nrv\api\representations\Representation;
use nrv\core\application\ports\api\ServiceCommandeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/** POST /commandes/{id}/paiement {numero, expiration, code} (fonctionnalités 9 et 10) */
class PayerCommandeAction extends AbstractAction
{
    public function __construct(private ServiceCommandeInterface $serviceCommande)
    {
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $c = $this->corps($rq);
        $commande = $this->serviceCommande->payer(
            $this->utilisateur($rq)->id,
            (int) $args['id'],
            $c['numero'] ?? null,
            $c['expiration'] ?? null,
            $c['code'] ?? null
        );
        return $this->json($rs, Representation::commande($commande));
    }
}
