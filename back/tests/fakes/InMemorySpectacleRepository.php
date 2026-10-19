<?php
declare(strict_types=1);

namespace nrv\tests\fakes;

use DateTimeImmutable;
use nrv\core\application\ports\spi\SpectacleRepositoryInterface;
use nrv\core\domain\entities\Spectacle;

/** Adaptateur de sortie en mémoire : le domaine se teste sans base de données. */
final class InMemorySpectacleRepository implements SpectacleRepositoryInterface
{
    /** @param Spectacle[] $spectacles */
    public function __construct(private array $spectacles)
    {
        usort($this->spectacles, fn ($a, $b) => $a->horaire <=> $b->horaire);
    }

    public function findAll(?DateTimeImmutable $date, ?int $styleId, int $offset, int $limit): array
    {
        return array_slice($this->filtrer($date, $styleId), $offset, $limit);
    }

    public function count(?DateTimeImmutable $date, ?int $styleId): int
    {
        return count($this->filtrer($date, $styleId));
    }

    public function findBySoiree(int $soireeId): array
    {
        return array_values(array_filter($this->spectacles, fn ($s) => $s->soireeId === $soireeId));
    }

    private function filtrer(?DateTimeImmutable $date, ?int $styleId): array
    {
        return array_values(array_filter($this->spectacles, fn (Spectacle $s) =>
            ($date === null || $s->horaire->format('Y-m-d') === $date->format('Y-m-d'))
            && ($styleId === null || $s->style->id === $styleId)));
    }
}
