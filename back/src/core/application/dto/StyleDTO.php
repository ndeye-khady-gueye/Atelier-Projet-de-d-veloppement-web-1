<?php
declare(strict_types=1);

namespace nrv\core\application\dto;

use nrv\core\domain\entities\Style;

final class StyleDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $libelle
    ) {
    }

    public static function fromEntity(Style $style): self
    {
        return new self($style->id, $style->libelle);
    }

    public function toArray(): array
    {
        return ['id' => $this->id, 'libelle' => $this->libelle];
    }
}
