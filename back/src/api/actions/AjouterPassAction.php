<?php
declare(strict_types=1);

namespace nrv\api\actions;

use nrv\api\representations\Representation;
use nrv\core\application\ports\api\ServicePanierInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/** POST /panier/pass {soirees: [id1, id2, id3], categorie} : pass 3 jours, remise de 3 % */
class AjouterPassAction extends AbstractAction
{
    public function __construct(private ServicePanierInterface $servicePanier)
    {
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $c = $this->corps($rq);
        $panier = $this->servicePanier->ajouterPass($this->utilisateur($rq)->id, $c['soirees'] ?? null, $c['categorie'] ?? null);
        return $this->json($rs, Representation::panier($panier), 201);
    }
}
