<?php
declare(strict_types=1);

namespace nrv\core\domain\entities;

/** Billet non nominatif : accessible par une URL contenant un token aléatoire. */
final class Billet
{
    public function __construct(
        public readonly string $reference,
        public readonly string $token,
        public readonly int $soireeId,
        public readonly string $categorie,
        public readonly float $prix
    ) {
    }

    public static function generer(int $soireeId, string $categorie, float $prix): self
    {
        return new self(
            'NRV-' . strtoupper(bin2hex(random_bytes(5))),
            bin2hex(random_bytes(32)),
            $soireeId,
            $categorie,
            $prix
        );
    }
}
