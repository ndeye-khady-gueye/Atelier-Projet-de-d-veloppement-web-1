<?php
declare(strict_types=1);

namespace nrv\core\application\dto;

/** Identité extraite du jeton, transmise aux actions par le middleware d'authentification. */
final class UtilisateurConnecteDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $role
    ) {
    }

    public function estAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
