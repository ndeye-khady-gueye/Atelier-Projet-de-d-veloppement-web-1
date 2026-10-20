<?php
declare(strict_types=1);

namespace nrv\core\domain\entities;

final class Lieu
{
    public function __construct(
        public readonly int $id,
        public readonly string $nom,
        public readonly string $adresse,
        public readonly int $nbPlaces
    ) {
    }
}
