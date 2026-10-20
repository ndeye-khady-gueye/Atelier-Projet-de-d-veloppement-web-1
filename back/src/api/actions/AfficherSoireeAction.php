<?php
declare(strict_types=1);

namespace nrv\api\actions;

use nrv\core\application\exceptions\ServiceNotFoundException;
use nrv\core\application\ports\api\ServiceProgrammeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;

/** GET /soirees/{id} : détail d'une soirée (fonctionnalités 2 et 3). */
class AfficherSoireeAction extends AbstractAction
{
    public function __construct(private ServiceProgrammeInterface $serviceProgramme)
    {
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $id = (int) $args['id'];
        try {
            $soiree = $this->serviceProgramme->afficherSoiree($id);
        } catch (ServiceNotFoundException $e) {
            throw new HttpNotFoundException($rq, $e->getMessage());
        }

        $data = $soiree->toArray();
        $data['spectacles'] = array_map(fn ($s) => $s->toArray(), $soiree->spectacles);

        return $this->json($rs, [
            'type' => 'resource',
            'soiree' => $data,
            'links' => [
                'self' => ['href' => "/soirees/$id"],
                'spectacles' => ['href' => '/spectacles?date=' . $soiree->date],
                'ajouter_au_panier' => ['href' => '/panier/lignes', 'method' => 'POST'],
            ],
        ]);
    }
}
