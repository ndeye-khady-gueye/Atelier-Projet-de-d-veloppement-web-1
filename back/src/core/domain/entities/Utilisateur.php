<?php
declare(strict_types=1);

namespace nrv\core\domain\entities;

final class Utilisateur
{
    public const CLIENT = 'client';
    public const ADMIN = 'admin';

    public function __construct(
        public readonly int $id,
        public readonly string $nom,
        public readonly string $email,
        public readonly string $passwordHash,
        public readonly string $role = self::CLIENT
    ) {
    }

    public function estAdmin(): bool
    {
        return $this->role === self::ADMIN;
    }
}
