<?php
declare(strict_types=1);

namespace nrv\tests\fakes;

use nrv\core\application\ports\spi\UtilisateurRepositoryInterface;
use nrv\core\domain\entities\Utilisateur;
use nrv\core\domain\exceptions\EntityNotFoundException;

final class InMemoryUtilisateurRepository implements UtilisateurRepositoryInterface
{
    /** @var Utilisateur[] */
    public array $utilisateurs = [];

    public function findByEmail(string $email): ?Utilisateur
    {
        foreach ($this->utilisateurs as $u) {
            if ($u->email === $email) {
                return $u;
            }
        }
        return null;
    }

    public function findById(int $id): Utilisateur
    {
        return $this->utilisateurs[$id] ?? throw new EntityNotFoundException("Utilisateur $id introuvable");
    }

    public function creer(string $nom, string $email, string $passwordHash, string $role): Utilisateur
    {
        $id = count($this->utilisateurs) + 1;
        return $this->utilisateurs[$id] = new Utilisateur($id, $nom, $email, $passwordHash, $role);
    }
}
