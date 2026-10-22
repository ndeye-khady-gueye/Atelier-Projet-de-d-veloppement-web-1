<?php
declare(strict_types=1);

namespace nrv\core\application\dto;

use nrv\core\domain\entities\Soiree;

final class SoireeResumeDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $nom,
        public readonly string $date,
        public readonly string $horaire,
        public readonly string $lieu,
        public readonly int $placesRestantes
    ) {
    }

    public static function fromEntity(Soiree $s): self
    {
        return new self($s->id, $s->nom, $s->debut->format('Y-m-d'), $s->debut->format('H:i'), $s->lieu->nom, $s->placesRestantes());
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'date' => $this->date,
            'horaire' => $this->horaire,
            'lieu' => $this->lieu,
            'places_restantes' => $this->placesRestantes,
            'complet' => $this->placesRestantes === 0,
        ];
    }
}
