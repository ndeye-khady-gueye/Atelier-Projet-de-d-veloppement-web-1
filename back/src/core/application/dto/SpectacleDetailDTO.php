<?php
declare(strict_types=1);

namespace nrv\core\application\dto;

use nrv\core\domain\entities\Spectacle;

/** Spectacle tel qu'affiché dans le détail d'une soirée. */
final class SpectacleDetailDTO
{
    /**
     * @param string[] $artistes
     * @param string[] $images
     */
    public function __construct(
        public readonly int $id,
        public readonly string $titre,
        public readonly array $artistes,
        public readonly string $description,
        public readonly string $style,
        public readonly ?string $video,
        public readonly string $horaire,
        public readonly array $images
    ) {
    }

    public static function fromEntity(Spectacle $s): self
    {
        return new self(
            $s->id,
            $s->titre,
            $s->artistes,
            $s->description,
            $s->style->libelle,
            $s->urlVideo,
            $s->horaire->format('H:i'),
            $s->images
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'artistes' => $this->artistes,
            'description' => $this->description,
            'style' => $this->style,
            'video' => $this->video,
            'horaire' => $this->horaire,
            'images' => $this->images,
        ];
    }
}
