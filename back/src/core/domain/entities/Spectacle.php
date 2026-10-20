<?php
declare(strict_types=1);

namespace nrv\core\domain\entities;

use DateTimeImmutable;

final class Spectacle
{
    /**
     * @param string[] $artistes noms des artistes
     * @param string[] $images   URL des images
     */
    public function __construct(
        public readonly int $id,
        public readonly string $titre,
        public readonly string $description,
        public readonly ?string $urlVideo,
        public readonly DateTimeImmutable $horaire,
        public readonly Style $style,
        public readonly int $soireeId,
        public readonly array $artistes = [],
        public readonly array $images = []
    ) {
    }

    public function imagePrincipale(): ?string
    {
        return $this->images[0] ?? null;
    }
}
