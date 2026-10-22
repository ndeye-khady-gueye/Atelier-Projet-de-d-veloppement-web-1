<?php
declare(strict_types=1);

namespace nrv\core\application\dto;

final class LignePanierDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $soireeId,
        public readonly string $soireeNom,
        public readonly string $date,
        public readonly string $horaire,
        public readonly string $categorie,
        public readonly int $quantite,
        public readonly float $prixUnitaire,
        public readonly float $sousTotal,
        public readonly ?string $pass
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'soiree' => ['id' => $this->soireeId, 'nom' => $this->soireeNom, 'date' => $this->date, 'horaire' => $this->horaire],
            'categorie' => $this->categorie,
            'quantite' => $this->quantite,
            'prix_unitaire' => $this->prixUnitaire,
            'sous_total' => $this->sousTotal,
            'pass' => $this->pass,
        ];
    }
}
