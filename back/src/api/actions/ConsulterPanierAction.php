<?php
declare(strict_types=1);

namespace nrv\api\actions;

use nrv\api\representations\Representation;
use nrv\core\application\ports\api\ServicePanierInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/** GET /panier (fonctionnalité 7) */
class ConsulterPanierAction extends AbstractAction
{
    public function __construct(private ServicePanierInterface $servicePanier)
    {
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $panier = $this->servicePanier->consulter($this->utilisateur($rq)->id);
        return $this->json($rs, Representation::panier($panier));
    }
}
