<?php
declare(strict_types=1);

namespace nrv\core\application\dto;

use nrv\core\domain\entities\JaugeSoiree;

final class JaugeDTO
{
    public function __construct(
        public readonly int $soireeId,
        public readonly string $nom,
        public readonly string $date,
        public readonly string $lieu,
        public readonly int $capacite,
        public readonly int $placesVendues,
        public readonly int $placesRestantes,
        public readonly int $tauxRemplissage,
        public readonly float $recette
    ) {
    }

    public static function fromEntity(JaugeSoiree $j): self
    {
        return new self(
            $j->soireeId,
            $j->nom,
            $j->debut->format('Y-m-d'),
            $j->lieu,
            $j->capacite,
            $j->placesVendues,
            max(0, $j->capacite - $j->placesVendues),
            $j->tauxRemplissage(),
            $j->recette
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->soireeId,
            'nom' => $this->nom,
            'date' => $this->date,
            'lieu' => $this->lieu,
            'capacite' => $this->capacite,
            'places_vendues' => $this->placesVendues,
            'places_restantes' => $this->placesRestantes,
            'taux_remplissage' => $this->tauxRemplissage,
            'recette' => $this->recette,
        ];
    }
}
