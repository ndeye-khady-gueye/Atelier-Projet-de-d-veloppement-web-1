<?php
declare(strict_types=1);

namespace nrv\api\actions;

use nrv\core\application\ports\api\ServiceProgrammeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/** GET /soirees : toutes les soirées (utilisé pour choisir les 3 soirées d'un pass) */
class ListerSoireesAction extends AbstractAction
{
    public function __construct(private ServiceProgrammeInterface $serviceProgramme)
    {
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $soirees = array_map(fn ($s) => [
            'soiree' => $s->toArray(),
            'links' => ['self' => ['href' => '/soirees/' . $s->id]],
        ], $this->serviceProgramme->listerSoirees());
        return $this->json($rs, [
            'type' => 'collection',
            'count' => count($soirees),
            'soirees' => $soirees,
            'links' => ['self' => ['href' => '/soirees']],
        ]);
    }
}
