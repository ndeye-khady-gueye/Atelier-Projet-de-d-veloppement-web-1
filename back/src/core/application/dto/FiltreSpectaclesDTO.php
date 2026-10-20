<?php
declare(strict_types=1);

namespace nrv\core\application\dto;

/**
 * Paramètres bruts reçus par l'API ; ils sont validés par le service.
 */
final class FiltreSpectaclesDTO
{
    public function __construct(
        public readonly ?string $date = null,
        public readonly ?string $styleId = null,
        public readonly ?string $page = null,
        public readonly int $taille = 12
    ) {
    }
}
