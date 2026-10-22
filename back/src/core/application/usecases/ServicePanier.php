<?php
declare(strict_types=1);

namespace nrv\core\application\usecases;

use DateTimeImmutable;
use nrv\core\application\dto\CommandeDTO;
use nrv\core\application\dto\PanierDTO;
use nrv\core\application\exceptions\ServiceConflictException;
use nrv\core\application\exceptions\ServiceInvalidDataException;
use nrv\core\application\exceptions\ServiceNotFoundException;
use nrv\core\application\ports\api\ServicePanierInterface;
use nrv\core\application\ports\spi\CommandeRepositoryInterface;
use nrv\core\application\ports\spi\PanierRepositoryInterface;
use nrv\core\application\ports\spi\SoireeRepositoryInterface;
use nrv\core\domain\entities\Commande;
use nrv\core\domain\entities\GrilleTarifaire;
use nrv\core\domain\entities\LigneCommande;
use nrv\core\domain\entities\Soiree;
use nrv\core\domain\exceptions\EntityNotFoundException;

class ServicePanier implements ServicePanierInterface
{
    public const QUANTITE_MAX = 10;

    public function __construct(
        private PanierRepositoryInterface $panierRepository,
        private SoireeRepositoryInterface $soireeRepository,
        private CommandeRepositoryInterface $commandeRepository,
        private GrilleTarifaire $grilleTarifaire
    ) {
    }

    public function consulter(int $utilisateurId): PanierDTO
    {
        return PanierDTO::fromEntity($this->panierRepository->findByUtilisateur($utilisateurId), $this->grilleTarifaire);
    }

    public function ajouterBillets(int $utilisateurId, mixed $soireeId, mixed $categorie, mixed $quantite): PanierDTO
    {
        $soiree = $this->soiree($soireeId);
        $categorie = $this->validerCategorie($categorie);
        $quantite = $this->validerQuantite($quantite);

        // fonctionnalité étendue : le panier ne peut pas dépasser les places restantes
        $dejaDansPanier = $this->panierRepository->findByUtilisateur($utilisateurId)->quantitePourSoiree($soiree->id);
        $this->verifierPlaces($soiree, $dejaDansPanier + $quantite);

        $this->panierRepository->ajouterLigne($utilisateurId, $soiree->id, $categorie, $quantite);
        return $this->consulter($utilisateurId);
    }

    public function ajouterPass(int $utilisateurId, mixed $soireeIds, mixed $categorie): PanierDTO
    {
        if (!is_array($soireeIds) || count($soireeIds) !== 3 || count(array_unique(array_map('strval', $soireeIds))) !== 3) {
            throw new ServiceInvalidDataException('Un pass 3 jours porte sur 3 soirées différentes');
        }
        $categorie = $this->validerCategorie($categorie);
        $panier = $this->panierRepository->findByUtilisateur($utilisateurId);
        $soirees = array_map(fn ($id) => $this->soiree($id), $soireeIds);
        foreach ($soirees as $s) {
            $this->verifierPlaces($s, $panier->quantitePourSoiree($s->id) + 1);
        }
        $passId = bin2hex(random_bytes(8));
        foreach ($soirees as $s) {
            $this->panierRepository->ajouterLigne($utilisateurId, $s->id, $categorie, 1, $passId);
        }
        return $this->consulter($utilisateurId);
    }

    public function modifierQuantite(int $utilisateurId, int $ligneId, mixed $quantite): PanierDTO
    {
        $panier = $this->panierRepository->findByUtilisateur($utilisateurId);
        $ligne = $panier->ligne($ligneId) ?? throw new ServiceNotFoundException("Ligne $ligneId absente du panier");
        if ($ligne->estPass()) {
            throw new ServiceInvalidDataException("La quantité d'un pass 3 jours ne se modifie pas : supprimez le pass");
        }
        $quantite = $this->validerQuantite($quantite);
        $autres = $panier->quantitePourSoiree($ligne->soireeId) - $ligne->quantite;
        $this->verifierPlaces($this->soiree($ligne->soireeId), $autres + $quantite);

        $this->panierRepository->modifierQuantite($utilisateurId, $ligneId, $quantite);
        return $this->consulter($utilisateurId);
    }

    public function supprimerLigne(int $utilisateurId, int $ligneId): PanierDTO
    {
        if ($this->panierRepository->findByUtilisateur($utilisateurId)->ligne($ligneId) === null) {
            throw new ServiceNotFoundException("Ligne $ligneId absente du panier");
        }
        $this->panierRepository->supprimerLigne($utilisateurId, $ligneId);
        return $this->consulter($utilisateurId);
    }

    public function valider(int $utilisateurId): CommandeDTO
    {
        $panier = $this->panierRepository->findByUtilisateur($utilisateurId);
        if ($panier->estVide()) {
            throw new ServiceInvalidDataException('Le panier est vide');
        }
        $lignes = array_map(fn ($l) => new LigneCommande(
            $l->soireeId,
            $l->categorie,
            $l->quantite,
            $panier->prixUnitaire($l, $this->grilleTarifaire),
            $l->passId
        ), $panier->lignes);

        $commande = $this->commandeRepository->creer(new Commande(
            null,
            $utilisateurId,
            new DateTimeImmutable(),
            $panier->total($this->grilleTarifaire),
            Commande::EN_ATTENTE,
            $lignes
        ));
        $this->panierRepository->vider($utilisateurId);
        return CommandeDTO::fromEntity($commande);
    }

    private function soiree(mixed $id): Soiree
    {
        if (!is_int($id) && !(is_string($id) && ctype_digit($id))) {
            throw new ServiceInvalidDataException('Identifiant de soirée invalide');
        }
        try {
            return $this->soireeRepository->findById((int) $id);
        } catch (EntityNotFoundException) {
            throw new ServiceNotFoundException("Soirée $id introuvable");
        }
    }

    private function validerCategorie(mixed $categorie): string
    {
        if (!in_array($categorie, [GrilleTarifaire::NORMAL, GrilleTarifaire::REDUIT], true)) {
            throw new ServiceInvalidDataException('Catégorie de tarif invalide : « normal » ou « reduit »');
        }
        return $categorie;
    }

    private function validerQuantite(mixed $quantite): int
    {
        $q = filter_var($quantite, FILTER_VALIDATE_INT);
        if ($q === false || $q < 1 || $q > self::QUANTITE_MAX) {
            throw new ServiceInvalidDataException('Quantité invalide : entre 1 et ' . self::QUANTITE_MAX);
        }
        return $q;
    }

    private function verifierPlaces(Soiree $soiree, int $demandees): void
    {
        if ($demandees > $soiree->placesRestantes()) {
            throw new ServiceConflictException(sprintf(
                'Plus assez de places pour « %s » : %d restante(s)',
                $soiree->nom,
                $soiree->placesRestantes()
            ));
        }
    }
}
