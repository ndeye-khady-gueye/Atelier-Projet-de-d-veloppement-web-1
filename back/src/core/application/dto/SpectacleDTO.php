<?php
declare(strict_types=1);

namespace nrv\core\application\dto;

use nrv\core\domain\entities\Spectacle;

/** Spectacle tel qu'affiché dans la liste du programme. */
final class SpectacleDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $titre,
        public readonly string $date,
        public readonly string $horaire,
        public readonly ?string $image,
        public readonly string $style,
        public readonly int $soireeId
    ) {
    }

    public static function fromEntity(Spectacle $s): self
    {
        return new self(
            $s->id,
            $s->titre,
            $s->horaire->format('Y-m-d'),
            $s->horaire->format('H:i'),
            $s->imagePrincipale(),
            $s->style->libelle,
            $s->soireeId
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'date' => $this->date,
            'horaire' => $this->horaire,
            'image' => $this->image,
            'style' => $this->style,
        ];
    }
}
