<?php
declare(strict_types=1);

namespace nrv\core\application\usecases;

use DateTimeImmutable;
use nrv\core\application\dto\BilletDTO;
use nrv\core\application\dto\CommandeDTO;
use nrv\core\application\exceptions\ServiceConflictException;
use nrv\core\application\exceptions\ServiceInvalidDataException;
use nrv\core\application\exceptions\ServiceNotFoundException;
use nrv\core\application\ports\api\ServiceCommandeInterface;
use nrv\core\application\ports\spi\CommandeRepositoryInterface;
use nrv\core\domain\entities\Billet;
use nrv\core\domain\entities\Commande;
use nrv\core\domain\exceptions\EntityNotFoundException;
use nrv\core\domain\exceptions\PlacesInsuffisantesException;

class ServiceCommande implements ServiceCommandeInterface
{
    public function __construct(
        private CommandeRepositoryInterface $commandeRepository,
        private ?DateTimeImmutable $maintenant = null
    ) {
    }

    public function consulter(int $utilisateurId, int $commandeId): CommandeDTO
    {
        $commande = $this->commandeDe($utilisateurId, $commandeId);
        return CommandeDTO::fromEntity($commande, $this->billets($commande));
    }

    public function payer(int $utilisateurId, int $commandeId, mixed $numero, mixed $expiration, mixed $code): CommandeDTO
    {
        $commande = $this->commandeDe($utilisateurId, $commandeId);
        if ($commande->estPayee()) {
            throw new ServiceConflictException("La commande $commandeId est déjà payée");
        }
        $this->validerCarte($numero, $expiration, $code);

        $billets = [];
        foreach ($commande->lignes as $ligne) {
            for ($i = 0; $i < $ligne->quantite; $i++) {
                $billets[] = Billet::generer($ligne->soireeId, $ligne->categorie, $ligne->prixUnitaire);
            }
        }
        try {
            $this->commandeRepository->enregistrerPaiement($commande, $billets);
        } catch (PlacesInsuffisantesException $e) {
            throw new ServiceConflictException($e->getMessage());
        }
        return $this->consulter($utilisateurId, $commandeId);
    }

    public function billet(string $token): BilletDTO
    {
        if (!preg_match('/^[0-9a-f]{64}$/', $token)) {
            throw new ServiceNotFoundException('Billet introuvable');
        }
        try {
            return BilletDTO::fromArray($this->commandeRepository->findBilletByToken($token));
        } catch (EntityNotFoundException) {
            throw new ServiceNotFoundException('Billet introuvable');
        }
    }

    /** Une commande n'est visible que par son propriétaire (sinon : introuvable). */
    private function commandeDe(int $utilisateurId, int $commandeId): Commande
    {
        try {
            $commande = $this->commandeRepository->findById($commandeId);
        } catch (EntityNotFoundException) {
            $commande = null;
        }
        if ($commande === null || $commande->utilisateurId !== $utilisateurId) {
            throw new ServiceNotFoundException("Commande $commandeId introuvable");
        }
        return $commande;
    }

    /** @return BilletDTO[] */
    private function billets(Commande $commande): array
    {
        return array_map(fn ($b) => BilletDTO::fromArray($b), $this->commandeRepository->findBilletsByCommande((int) $commande->id));
    }

    /** Paiement simulé : on contrôle seulement le format des données de la carte. */
    private function validerCarte(mixed $numero, mixed $expiration, mixed $code): void
    {
        $numero = is_string($numero) ? preg_replace('/[\s-]/', '', $numero) : '';
        if (!preg_match('/^\d{16}$/', $numero)) {
            throw new ServiceInvalidDataException('Numéro de carte invalide : 16 chiffres');
        }
        if (!is_string($expiration) || !preg_match('#^(0[1-9]|1[0-2])/(\d{2})$#', $expiration, $m)) {
            throw new ServiceInvalidDataException("Date d'expiration invalide : MM/AA");
        }
        $finValidite = DateTimeImmutable::createFromFormat('!Y-m-d', "20{$m[2]}-{$m[1]}-01")->modify('+1 month');
        if ($finValidite <= ($this->maintenant ?? new DateTimeImmutable())) {
            throw new ServiceInvalidDataException('La carte est expirée');
        }
        if (!is_string($code) || !preg_match('/^\d{3}$/', $code)) {
            throw new ServiceInvalidDataException('Code de sécurité invalide : 3 chiffres');
        }
    }
}
