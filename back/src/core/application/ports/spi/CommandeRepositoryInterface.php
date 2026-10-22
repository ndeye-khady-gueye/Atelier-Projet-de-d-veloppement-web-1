<?php
declare(strict_types=1);

namespace nrv\core\application\ports\spi;

use nrv\core\domain\entities\Billet;
use nrv\core\domain\entities\Commande;
use nrv\core\domain\exceptions\EntityNotFoundException;
use nrv\core\domain\exceptions\PlacesInsuffisantesException;

interface CommandeRepositoryInterface
{
    /** Enregistre une nouvelle commande et ses lignes ; renvoie la commande avec son id. */
    public function creer(Commande $commande): Commande;

    /** @throws EntityNotFoundException */
    public function findById(int $id): Commande;

    /**
     * En une seule transaction : décompte des places de chaque soirée, enregistrement des billets
     * et passage de la commande au statut « payée ». Rien n'est modifié en cas d'échec.
     * @param Billet[] $billets
     * @throws PlacesInsuffisantesException si une soirée n'a plus assez de places
     */
    public function enregistrerPaiement(Commande $commande, array $billets): void;

    /**
     * Billets avec les informations nécessaires à leur affichage.
     * @return array<int, array{reference: string, token: string, categorie: string, prix: float,
     *   acheteur: string, soiree: string, debut: string, lieu: string, adresse: string}>
     */
    public function findBilletsByCommande(int $commandeId): array;

    /**
     * @return array{reference: string, token: string, categorie: string, prix: float,
     *   acheteur: string, soiree: string, debut: string, lieu: string, adresse: string}
     * @throws EntityNotFoundException
     */
    public function findBilletByToken(string $token): array;
}
