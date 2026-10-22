<?php
declare(strict_types=1);

namespace nrv\api\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        return $this->json($rs, [
            'type' => 'resource',
            'api' => 'NRV.net',
            'links' => [
                'spectacles' => ['href' => '/spectacles'],
                'styles' => ['href' => '/styles'],
                'soirees' => ['href' => '/soirees'],
            ],
        ]);
    }
}
