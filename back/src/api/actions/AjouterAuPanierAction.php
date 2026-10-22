<?php
declare(strict_types=1);

namespace nrv\api\actions;

use nrv\api\representations\Representation;
use nrv\core\application\ports\api\ServicePanierInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/** POST /panier/lignes {soiree, categorie, quantite} (fonctionnalité 6) */
class AjouterAuPanierAction extends AbstractAction
{
    public function __construct(private ServicePanierInterface $servicePanier)
    {
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $c = $this->corps($rq);
        $panier = $this->servicePanier->ajouterBillets(
            $this->utilisateur($rq)->id,
            $c['soiree'] ?? null,
            $c['categorie'] ?? null,
            $c['quantite'] ?? 1
        );
        return $this->json($rs, Representation::panier($panier), 201);
    }
}
