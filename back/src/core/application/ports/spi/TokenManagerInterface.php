<?php
declare(strict_types=1);

namespace nrv\core\application\ports\spi;

use nrv\core\application\exceptions\ServiceAuthException;
use nrv\core\domain\entities\Utilisateur;

/** Création et vérification des jetons d'authentification (implémenté en JWT dans infra). */
interface TokenManagerInterface
{
    public function creer(Utilisateur $utilisateur): string;

    /**
     * @return array{id: int, role: string}
     * @throws ServiceAuthException jeton invalide ou expiré
     */
    public function verifier(string $token): array;
}
