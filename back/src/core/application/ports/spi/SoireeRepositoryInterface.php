<?php
declare(strict_types=1);

namespace nrv\core\application\ports\spi;

use nrv\core\domain\entities\JaugeSoiree;
use nrv\core\domain\entities\Soiree;
use nrv\core\domain\exceptions\EntityNotFoundException;

interface SoireeRepositoryInterface
{
    /** @throws EntityNotFoundException */
    public function findById(int $id): Soiree;

    /** @return Soiree[] toutes les soirées, par date */
    public function findAll(): array;

    /** @return JaugeSoiree[] toutes les soirées avec places vendues et recette, par date */
    public function findAllJauges(): array;
}
