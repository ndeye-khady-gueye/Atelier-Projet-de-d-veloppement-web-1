<?php
declare(strict_types=1);

namespace nrv\api\actions;

use nrv\api\representations\Representation;
use nrv\core\application\ports\api\ServiceAuthentificationInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/** POST /auth/register {nom, email, password} */
class InscriptionAction extends AbstractAction
{
    public function __construct(private ServiceAuthentificationInterface $serviceAuth)
    {
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $c = $this->corps($rq);
        $auth = $this->serviceAuth->inscrire($c['nom'] ?? null, $c['email'] ?? null, $c['password'] ?? null);
        return $this->json($rs, Representation::auth($auth), 201);
    }
}
