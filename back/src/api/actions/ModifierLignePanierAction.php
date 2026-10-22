<?php
declare(strict_types=1);

namespace nrv\api\actions;

use nrv\api\representations\Representation;
use nrv\core\application\ports\api\ServicePanierInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/** PATCH /panier/lignes/{id} {quantite} (fonctionnalité étendue) */
class ModifierLignePanierAction extends AbstractAction
{
    public function __construct(private ServicePanierInterface $servicePanier)
    {
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $panier = $this->servicePanier->modifierQuantite(
            $this->utilisateur($rq)->id,
            (int) $args['id'],
            $this->corps($rq)['quantite'] ?? null
        );
        return $this->json($rs, Representation::panier($panier));
    }
}
