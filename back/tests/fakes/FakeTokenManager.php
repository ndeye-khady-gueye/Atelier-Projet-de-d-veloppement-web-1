<?php
declare(strict_types=1);

namespace nrv\tests\fakes;

use nrv\core\application\exceptions\ServiceAuthException;
use nrv\core\application\ports\spi\TokenManagerInterface;
use nrv\core\domain\entities\Utilisateur;

/** Jeton lisible pour les tests : « id:role ». */
final class FakeTokenManager implements TokenManagerInterface
{
    public function creer(Utilisateur $utilisateur): string
    {
        return $utilisateur->id . ':' . $utilisateur->role;
    }

    public function verifier(string $token): array
    {
        if (!preg_match('/^(\d+):(client|admin)$/', $token, $m)) {
            throw new ServiceAuthException('Jeton invalide');
        }
        return ['id' => (int) $m[1], 'role' => $m[2]];
    }
}
