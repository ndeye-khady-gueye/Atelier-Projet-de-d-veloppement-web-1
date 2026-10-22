<?php
declare(strict_types=1);

namespace nrv\core\domain\entities;

use DateTimeImmutable;

/** Remplissage et recette d'une soirée (back-office). */
final class JaugeSoiree
{
    public function __construct(
        public readonly int $soireeId,
        public readonly string $nom,
        public readonly DateTimeImmutable $debut,
        public readonly string $lieu,
        public readonly int $capacite,
        public readonly int $placesVendues,
        public readonly float $recette
    ) {
    }

    public function tauxRemplissage(): int
    {
        return $this->capacite > 0 ? (int) round(100 * $this->placesVendues / $this->capacite) : 0;
    }
}
