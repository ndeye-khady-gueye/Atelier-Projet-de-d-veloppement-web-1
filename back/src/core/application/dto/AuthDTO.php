<?php
declare(strict_types=1);

namespace nrv\core\application\dto;

use nrv\core\domain\entities\Utilisateur;

/** Utilisateur connecté + jeton à envoyer dans l'en-tête « Authorization: Bearer ». */
final class AuthDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $nom,
        public readonly string $email,
        public readonly string $role,
        public readonly string $token
    ) {
    }

    public static function fromEntity(Utilisateur $u, string $token): self
    {
        return new self($u->id, $u->nom, $u->email, $u->role, $token);
    }

    public function toArray(): array
    {
        return ['id' => $this->id, 'nom' => $this->nom, 'email' => $this->email, 'role' => $this->role];
    }
}
