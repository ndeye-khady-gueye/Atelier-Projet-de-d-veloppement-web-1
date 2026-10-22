<?php
declare(strict_types=1);

namespace nrv\core\domain\entities;

use DateTimeImmutable;

/** Une ligne du panier : n billets d'une catégorie pour une soirée (ou 1 billet d'un pass 3 jours). */
final class LignePanier
{
    public function __construct(
        public readonly int $id,
        public readonly int $soireeId,
        public readonly string $soireeNom,
        public readonly DateTimeImmutable $soireeDebut,
        public readonly string $categorie,
        public readonly int $quantite,
        public readonly ?string $passId = null
    ) {
    }

    public function estPass(): bool
    {
        return $this->passId !== null;
    }
}
