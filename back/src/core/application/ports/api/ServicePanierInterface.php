<?php
declare(strict_types=1);

namespace nrv\core\application\ports\api;

use nrv\core\application\dto\CommandeDTO;
use nrv\core\application\dto\PanierDTO;
use nrv\core\application\exceptions\ServiceConflictException;
use nrv\core\application\exceptions\ServiceInvalidDataException;
use nrv\core\application\exceptions\ServiceNotFoundException;

interface ServicePanierInterface
{
    public function consulter(int $utilisateurId): PanierDTO;

    /** Fonctionnalité 6 (+ contrôle des places disponibles). @throws ServiceInvalidDataException|ServiceNotFoundException|ServiceConflictException */
    public function ajouterBillets(int $utilisateurId, mixed $soireeId, mixed $categorie, mixed $quantite): PanierDTO;

    /** Pass 3 jours : 3 soirées différentes, remise de 3 %. */
    public function ajouterPass(int $utilisateurId, mixed $soireeIds, mixed $categorie): PanierDTO;

    /** Fonctionnalité étendue : modifier la quantité d'une ligne. */
    public function modifierQuantite(int $utilisateurId, int $ligneId, mixed $quantite): PanierDTO;

    public function supprimerLigne(int $utilisateurId, int $ligneId): PanierDTO;

    /** Fonctionnalité 8 : le panier devient une commande « en attente ». */
    public function valider(int $utilisateurId): CommandeDTO;
}
