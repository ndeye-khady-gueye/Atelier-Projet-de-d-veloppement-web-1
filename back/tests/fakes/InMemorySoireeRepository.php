<?php
declare(strict_types=1);

namespace nrv\tests\fakes;

use nrv\core\application\ports\spi\SoireeRepositoryInterface;
use nrv\core\domain\entities\JaugeSoiree;
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

    public function findAll(): array
    {
        return array_values($this->soirees);
    }

    public function findAllJauges(): array
    {
        return array_map(fn (Soiree $s) => new JaugeSoiree(
            $s->id, $s->nom, $s->debut, $s->lieu->nom, $s->lieu->nbPlaces, $s->placesVendues, 0.0
        ), $this->soirees);
    }
}
