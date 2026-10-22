<?php
declare(strict_types=1);

namespace nrv\core\domain\entities;

/** Ligne de commande : copie figée d'une ligne de panier, avec son prix au moment de la validation. */
final class LigneCommande
{
    public function __construct(
        public readonly int $soireeId,
        public readonly string $categorie,
        public readonly int $quantite,
        public readonly float $prixUnitaire,
        public readonly ?string $passId = null
    ) {
    }
}
