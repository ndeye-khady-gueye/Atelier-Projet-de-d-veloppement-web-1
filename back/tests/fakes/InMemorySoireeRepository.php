<?php
declare(strict_types=1);

namespace nrv\tests\fakes;

use nrv\core\application\ports\spi\SoireeRepositoryInterface;
use nrv\core\domain\entities\Soiree;
use nrv\core\domain\exceptions\EntityNotFoundException;

final class InMemorySoireeRepository implements SoireeRepositoryInterface
{
    /** @param Soiree[] $soirees */
    public function __construct(private array $soirees)
    {
    }

    public function findById(int $id): Soiree
    {
        foreach ($this->soirees as $s) {
            if ($s->id === $id) {
                return $s;
            }
        }
        throw new EntityNotFoundException("Soirée $id introuvable");
    }
}
