<?php
declare(strict_types=1);

namespace nrv\core\application\usecases;

use nrv\core\application\dto\AuthDTO;
use nrv\core\application\dto\UtilisateurConnecteDTO;
use nrv\core\application\exceptions\ServiceAuthException;
use nrv\core\application\exceptions\ServiceConflictException;
use nrv\core\application\exceptions\ServiceInvalidDataException;
use nrv\core\application\ports\api\ServiceAuthentificationInterface;
use nrv\core\application\ports\spi\TokenManagerInterface;
use nrv\core\application\ports\spi\UtilisateurRepositoryInterface;
use nrv\core\domain\entities\Utilisateur;

class ServiceAuthentification implements ServiceAuthentificationInterface
{
    private const MDP_MIN = 8;

    public function __construct(
        private UtilisateurRepositoryInterface $utilisateurRepository,
        private TokenManagerInterface $tokenManager
    ) {
    }

    public function inscrire(mixed $nom, mixed $email, mixed $motDePasse): AuthDTO
    {
        $nom = is_string($nom) ? trim($nom) : '';
        $email = $this->validerEmail($email);
        if ($nom === '' || mb_strlen($nom) > 128) {
            throw new ServiceInvalidDataException('Nom obligatoire (128 caractères maximum)');
        }
        if (!is_string($motDePasse) || mb_strlen($motDePasse) < self::MDP_MIN) {
            throw new ServiceInvalidDataException('Le mot de passe doit contenir au moins ' . self::MDP_MIN . ' caractères');
        }
        if ($this->utilisateurRepository->findByEmail($email) !== null) {
            throw new ServiceConflictException('Un compte existe déjà avec cet email');
        }
        $utilisateur = $this->utilisateurRepository->creer(
            $nom,
            $email,
            password_hash($motDePasse, PASSWORD_DEFAULT),
            Utilisateur::CLIENT
        );
        return AuthDTO::fromEntity($utilisateur, $this->tokenManager->creer($utilisateur));
    }

    public function connecter(mixed $email, mixed $motDePasse): AuthDTO
    {
        $utilisateur = is_string($email) ? $this->utilisateurRepository->findByEmail(mb_strtolower(trim($email))) : null;
        // même message que le compte existe ou non : on ne révèle pas les emails inscrits
        if ($utilisateur === null || !is_string($motDePasse) || !password_verify($motDePasse, $utilisateur->passwordHash)) {
            throw new ServiceAuthException('Email ou mot de passe incorrect');
        }
        return AuthDTO::fromEntity($utilisateur, $this->tokenManager->creer($utilisateur));
    }

    public function verifierToken(string $token): UtilisateurConnecteDTO
    {
        $payload = $this->tokenManager->verifier($token);
        return new UtilisateurConnecteDTO($payload['id'], $payload['role']);
    }

    private function validerEmail(mixed $email): string
    {
        $email = is_string($email) ? mb_strtolower(trim($email)) : '';
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false || mb_strlen($email) > 256) {
            throw new ServiceInvalidDataException('Adresse email invalide');
        }
        return $email;
    }
}
