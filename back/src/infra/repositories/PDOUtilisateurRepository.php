<?php
declare(strict_types=1);

namespace nrv\infra\repositories;

use nrv\core\application\ports\spi\UtilisateurRepositoryInterface;
use nrv\core\domain\entities\Utilisateur;
use nrv\core\domain\exceptions\EntityNotFoundException;
use PDO;

class PDOUtilisateurRepository implements UtilisateurRepositoryInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findByEmail(string $email): ?Utilisateur
    {
        $stmt = $this->pdo->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $r = $stmt->fetch();
        return $r === false ? null : $this->hydrater($r);
    }

    public function findById(int $id): Utilisateur
    {
        $stmt = $this->pdo->prepare('SELECT * FROM utilisateur WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $r = $stmt->fetch();
        if ($r === false) {
            throw new EntityNotFoundException("Utilisateur $id introuvable");
        }
        return $this->hydrater($r);
    }

    public function creer(string $nom, string $email, string $passwordHash, string $role): Utilisateur
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO utilisateur (nom, email, password_hash, role) VALUES (:nom, :email, :hash, :role) RETURNING id'
        );
        $stmt->execute(['nom' => $nom, 'email' => $email, 'hash' => $passwordHash, 'role' => $role]);
        return new Utilisateur((int) $stmt->fetchColumn(), $nom, $email, $passwordHash, $role);
    }

    private function hydrater(array $r): Utilisateur
    {
        return new Utilisateur((int) $r['id'], $r['nom'], $r['email'], $r['password_hash'], $r['role']);
    }
}
