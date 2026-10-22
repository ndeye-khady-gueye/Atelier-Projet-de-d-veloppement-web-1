<?php
declare(strict_types=1);

namespace nrv\core\application\ports\spi;

use nrv\core\domain\entities\Utilisateur;
use nrv\core\domain\exceptions\EntityNotFoundException;

interface UtilisateurRepositoryInterface
{
    public function findByEmail(string $email): ?Utilisateur;

    /** @throws EntityNotFoundException */
    public function findById(int $id): Utilisateur;

    public function creer(string $nom, string $email, string $passwordHash, string $role): Utilisateur;
}
