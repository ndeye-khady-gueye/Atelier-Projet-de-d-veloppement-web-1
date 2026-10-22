<?php
declare(strict_types=1);

namespace nrv\tests\fakes;

use nrv\core\application\ports\spi\PanierRepositoryInterface;
use nrv\core\application\ports\spi\SoireeRepositoryInterface;
use nrv\core\domain\entities\LignePanier;
use nrv\core\domain\entities\Panier;

final class InMemoryPanierRepository implements PanierRepositoryInterface
{
    /** @var array<int, LignePanier[]> lignes par utilisateur */
    private array $lignes = [];
    private int $prochainId = 1;

    public function __construct(private SoireeRepositoryInterface $soirees)
    {
    }

    public function findByUtilisateur(int $utilisateurId): Panier
    {
        return new Panier($utilisateurId, array_values($this->lignes[$utilisateurId] ?? []));
    }

    public function ajouterLigne(int $utilisateurId, int $soireeId, string $categorie, int $quantite, ?string $passId = null): void
    {
        foreach ($this->lignes[$utilisateurId] ?? [] as $id => $l) {
            if ($passId === null && !$l->estPass() && $l->soireeId === $soireeId && $l->categorie === $categorie) {
                $this->remplacer($utilisateurId, $l, $l->quantite + $quantite);
                return;
            }
        }
        $s = $this->soirees->findById($soireeId);
        $id = $this->prochainId++;
        $this->lignes[$utilisateurId][$id] = new LignePanier($id, $soireeId, $s->nom, $s->debut, $categorie, $quantite, $passId);
    }

    public function modifierQuantite(int $utilisateurId, int $ligneId, int $quantite): void
    {
        $l = $this->lignes[$utilisateurId][$ligneId] ?? null;
        if ($l !== null) {
            $this->remplacer($utilisateurId, $l, $quantite);
        }
    }

    public function supprimerLigne(int $utilisateurId, int $ligneId): void
    {
        $cible = $this->lignes[$utilisateurId][$ligneId] ?? null;
        foreach ($this->lignes[$utilisateurId] ?? [] as $id => $l) {
            if ($id === $ligneId || ($cible?->passId !== null && $l->passId === $cible->passId)) {
                unset($this->lignes[$utilisateurId][$id]);
            }
        }
    }

    public function vider(int $utilisateurId): void
    {
        $this->lignes[$utilisateurId] = [];
    }

    private function remplacer(int $u, LignePanier $l, int $q): void
    {
        $this->lignes[$u][$l->id] = new LignePanier($l->id, $l->soireeId, $l->soireeNom, $l->soireeDebut, $l->categorie, $q, $l->passId);
    }
}
