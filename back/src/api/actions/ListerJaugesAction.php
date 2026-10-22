<?php
declare(strict_types=1);

namespace nrv\api\actions;

use nrv\core\application\ports\api\ServiceBackofficeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/** GET /admin/soirees : jauge et recette de chaque soirée (fonctionnalité 11, gestionnaires) */
class ListerJaugesAction extends AbstractAction
{
    public function __construct(private ServiceBackofficeInterface $serviceBackoffice)
    {
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $soirees = array_map(fn ($j) => [
            'soiree' => $j->toArray(),
            'links' => ['soiree' => ['href' => '/soirees/' . $j->soireeId]],
        ], $this->serviceBackoffice->jauges());
        return $this->json($rs, [
            'type' => 'collection',
            'count' => count($soirees),
            'recette_totale' => round(array_sum(array_map(fn ($s) => $s['soiree']['recette'], $soirees)), 2),
            'soirees' => $soirees,
            'links' => ['self' => ['href' => '/admin/soirees']],
        ]);
    }
}
