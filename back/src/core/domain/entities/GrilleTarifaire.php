<?php
declare(strict_types=1);

namespace nrv\core\domain\entities;

use InvalidArgumentException;

/**
 * Tarif unique pour toutes les soirées, en deux catégories,
 * et une remise appliquée aux pass 3 jours.
 */
final class GrilleTarifaire
{
    public const NORMAL = 'normal';
    public const REDUIT = 'reduit';

    public function __construct(
        public readonly float $normal,
        public readonly float $reduit,
        public readonly float $remisePass
    ) {
        if ($normal <= 0 || $reduit <= 0 || $reduit > $normal) {
            throw new InvalidArgumentException('Grille tarifaire incohérente');
        }
        if ($remisePass < 0 || $remisePass >= 1) {
            throw new InvalidArgumentException('Remise du pass invalide');
        }
    }

    public function prix(string $categorie): float
    {
        return match ($categorie) {
            self::NORMAL => $this->normal,
            self::REDUIT => $this->reduit,
            default => throw new InvalidArgumentException("Catégorie de tarif inconnue : $categorie"),
        };
    }

    /** Prix d'un pass 3 jours : 3 billets de la catégorie, remise déduite. */
    public function prixPass(string $categorie): float
    {
        return round(3 * $this->prix($categorie) * (1 - $this->remisePass), 2);
    }
}
