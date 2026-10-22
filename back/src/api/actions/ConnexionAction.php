<?php
declare(strict_types=1);

namespace nrv\api\actions;

use nrv\api\representations\Representation;
use nrv\core\application\ports\api\ServiceAuthentificationInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/** POST /auth/signin {email, password} */
class ConnexionAction extends AbstractAction
{
    public function __construct(private ServiceAuthentificationInterface $serviceAuth)
    {
    }

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $c = $this->corps($rq);
        $auth = $this->serviceAuth->connecter($c['email'] ?? null, $c['password'] ?? null);
        return $this->json($rs, Representation::auth($auth));
    }
}
