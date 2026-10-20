<?php
declare(strict_types=1);

namespace nrv\api\actions;

use nrv\core\application\dto\FiltreSpectaclesDTO;
use nrv\core\application\exceptions\ServiceInvalidDataException;
use nrv\core\application\ports\api\ServiceProgrammeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;

/**
 * GET /spectacles?date=AAAA-MM-JJ&style={id}&page={n}
 * Fonctionnalités 1, 4, 5 (et pagination, fonctionnalité étendue 1).
 */
class ListerSpectaclesAction extends AbstractAction
{
    public function __construct(
        private ServiceProgrammeInterface $serviceProgramme,
        private int $taillePage
    ) {
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $q = $rq->getQueryParams();
        $filtre = new FiltreSpectaclesDTO(
            $this->param($q, 'date'),
            $this->param($q, 'style'),
            $this->param($q, 'page'),
            $this->taillePage
        );

        try {
            $page = $this->serviceProgramme->listerSpectacles($filtre);
        } catch (ServiceInvalidDataException $e) {
            throw new HttpBadRequestException($rq, $e->getMessage());
        }

        $spectacles = [];
        foreach ($page->spectacles as $s) {
            $spectacles[] = [
                'spectacle' => $s->toArray(),
                'links' => [
                    'soiree' => ['href' => '/soirees/' . $s->soireeId],
                ],
            ];
        }

        $links = ['self' => ['href' => $this->url($filtre, $page->page)]];
        if ($page->aPrecedente()) {
            $links['prev'] = ['href' => $this->url($filtre, $page->page - 1)];
        }
        if ($page->aSuivante()) {
            $links['next'] = ['href' => $this->url($filtre, $page->page + 1)];
        }
        $links['first'] = ['href' => $this->url($filtre, 1)];
        $links['last'] = ['href' => $this->url($filtre, $page->nbPages())];

        return $this->json($rs, [
            'type' => 'collection',
            'count' => count($spectacles),
            'total' => $page->total,
            'page' => $page->page,
            'pages' => $page->nbPages(),
            'spectacles' => $spectacles,
            'links' => $links,
        ]);
    }

    private function param(array $q, string $nom): ?string
    {
        return isset($q[$nom]) && is_string($q[$nom]) ? trim($q[$nom]) : null;
    }

    private function url(FiltreSpectaclesDTO $f, int $page): string
    {
        $params = array_filter(['date' => $f->date, 'style' => $f->styleId], fn ($v) => $v !== null && $v !== '');
        $params['page'] = $page;
        return '/spectacles?' . http_build_query($params);
    }
}
