<?php
declare(strict_types=1);

namespace nrv\api\actions;

use nrv\core\application\ports\api\ServiceProgrammeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/** GET /styles : alimente le filtre par style (fonctionnalité 5). */
class ListerStylesAction extends AbstractAction
{
    public function __construct(private ServiceProgrammeInterface $serviceProgramme)
    {
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $styles = [];
        foreach ($this->serviceProgramme->listerStyles() as $s) {
            $styles[] = [
                'style' => $s->toArray(),
                'links' => ['spectacles' => ['href' => '/spectacles?style=' . $s->id]],
            ];
        }
        return $this->json($rs, [
            'type' => 'collection',
            'count' => count($styles),
            'styles' => $styles,
            'links' => ['self' => ['href' => '/styles']],
        ]);
    }
}
