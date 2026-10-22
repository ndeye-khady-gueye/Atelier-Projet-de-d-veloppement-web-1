<?php
declare(strict_types=1);

namespace nrv\core\application\ports\api;

use nrv\core\application\dto\AuthDTO;
use nrv\core\application\dto\UtilisateurConnecteDTO;
use nrv\core\application\exceptions\ServiceAuthException;
use nrv\core\application\exceptions\ServiceConflictException;
use nrv\core\application\exceptions\ServiceInvalidDataException;

interface ServiceAuthentificationInterface
{
    /** @throws ServiceInvalidDataException|ServiceConflictException */
    public function inscrire(mixed $nom, mixed $email, mixed $motDePasse): AuthDTO;

    /** @throws ServiceAuthException */
    public function connecter(mixed $email, mixed $motDePasse): AuthDTO;

    /** @throws ServiceAuthException */
    public function verifierToken(string $token): UtilisateurConnecteDTO;
}
