<?php
declare(strict_types=1);

namespace nrv\core\domain\entities;

final class Style
{
    public function __construct(
        public readonly int $id,
        public readonly string $libelle
    ) {
    }
}
