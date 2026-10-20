<?php
declare(strict_types=1);

namespace nrv\core\application\ports\spi;

use DateTimeImmutable;
use nrv\core\domain\entities\Spectacle;

interface SpectacleRepositoryInterface
{
    /**
     * Spectacles triés par horaire, filtrés par date de soirée et/ou style.
     * @return Spectacle[]
     */
    public function findAll(?DateTimeImmutable $date, ?int $styleId, int $offset, int $limit): array;

    public function count(?DateTimeImmutable $date, ?int $styleId): int;

    /** @return Spectacle[] */
    public function findBySoiree(int $soireeId): array;
}
