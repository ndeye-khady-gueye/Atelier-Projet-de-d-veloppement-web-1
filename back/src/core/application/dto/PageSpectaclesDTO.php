<?php
declare(strict_types=1);

namespace nrv\core\application\dto;

final class PageSpectaclesDTO
{
    /** @param SpectacleDTO[] $spectacles */
    public function __construct(
        public readonly array $spectacles,
        public readonly int $page,
        public readonly int $taille,
        public readonly int $total
    ) {
    }

    public function nbPages(): int
    {
        return max(1, (int) ceil($this->total / $this->taille));
    }

    public function aSuivante(): bool
    {
        return $this->page < $this->nbPages();
    }

    public function aPrecedente(): bool
    {
        return $this->page > 1;
    }
}
