<?php
declare(strict_types=1);

namespace nrv\core\domain\entities;

use DateTimeImmutable;

final class Soiree
{
    public function __construct(
        public readonly int $id,
        public readonly string $nom,
        public readonly string $thematique,
        public readonly DateTimeImmutable $debut,
        public readonly Lieu $lieu,
        public readonly int $placesVendues = 0
    ) {
    }

    public function placesRestantes(): int
    {
        return max(0, $this->lieu->nbPlaces - $this->placesVendues);
    }

    public function estComplete(): bool
    {
        return $this->placesRestantes() === 0;
    }
}
