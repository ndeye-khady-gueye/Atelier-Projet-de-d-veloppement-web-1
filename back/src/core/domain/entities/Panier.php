<?php
declare(strict_types=1);

namespace nrv\core\domain\entities;

final class Panier
{
    /** @param LignePanier[] $lignes */
    public function __construct(
        public readonly int $utilisateurId,
        public readonly array $lignes = []
    ) {
    }

    public function estVide(): bool
    {
        return $this->lignes === [];
    }

    public function nbBillets(): int
    {
        return array_sum(array_map(fn (LignePanier $l) => $l->quantite, $this->lignes));
    }

    /** Nombre de billets déjà dans le panier pour une soirée (contrôle des places). */
    public function quantitePourSoiree(int $soireeId): int
    {
        return array_sum(array_map(
            fn (LignePanier $l) => $l->soireeId === $soireeId ? $l->quantite : 0,
            $this->lignes
        ));
    }

    public function prixUnitaire(LignePanier $ligne, GrilleTarifaire $grille): float
    {
        return $grille->prixUnitaire($ligne->categorie, $ligne->estPass());
    }

    public function total(GrilleTarifaire $grille): float
    {
        $total = 0.0;
        foreach ($this->lignes as $l) {
            $total += $this->prixUnitaire($l, $grille) * $l->quantite;
        }
        return round($total, 2);
    }

    public function ligne(int $id): ?LignePanier
    {
        foreach ($this->lignes as $l) {
            if ($l->id === $id) {
                return $l;
            }
        }
        return null;
    }
}
