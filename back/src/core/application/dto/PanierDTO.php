<?php
declare(strict_types=1);

namespace nrv\core\application\dto;

use nrv\core\domain\entities\GrilleTarifaire;
use nrv\core\domain\entities\Panier;

final class PanierDTO
{
    /** @param LignePanierDTO[] $lignes */
    public function __construct(
        public readonly array $lignes,
        public readonly int $nbBillets,
        public readonly float $montantTotal
    ) {
    }

    public static function fromEntity(Panier $p, GrilleTarifaire $g): self
    {
        $lignes = array_map(fn ($l) => new LignePanierDTO(
            $l->id,
            $l->soireeId,
            $l->soireeNom,
            $l->soireeDebut->format('Y-m-d'),
            $l->soireeDebut->format('H:i'),
            $l->categorie,
            $l->quantite,
            $p->prixUnitaire($l, $g),
            round($p->prixUnitaire($l, $g) * $l->quantite, 2),
            $l->passId
        ), $p->lignes);
        return new self($lignes, $p->nbBillets(), $p->total($g));
    }
}
