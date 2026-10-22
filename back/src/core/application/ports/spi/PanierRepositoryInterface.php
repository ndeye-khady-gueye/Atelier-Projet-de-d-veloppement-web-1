<?php
declare(strict_types=1);

namespace nrv\core\application\ports\spi;

use nrv\core\domain\entities\Panier;

interface PanierRepositoryInterface
{
    /** Panier de l'utilisateur (vide s'il n'en a pas encore). */
    public function findByUtilisateur(int $utilisateurId): Panier;

    public function ajouterLigne(int $utilisateurId, int $soireeId, string $categorie, int $quantite, ?string $passId = null): void;

    public function modifierQuantite(int $utilisateurId, int $ligneId, int $quantite): void;

    /** Supprime une ligne ; pour un pass, supprime les 3 lignes du pass. */
    public function supprimerLigne(int $utilisateurId, int $ligneId): void;

    public function vider(int $utilisateurId): void;
}
