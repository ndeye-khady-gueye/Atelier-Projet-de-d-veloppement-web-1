<?php
declare(strict_types=1);

namespace nrv\core\application\ports\spi;

use nrv\core\domain\entities\Soiree;
use nrv\core\domain\exceptions\EntityNotFoundException;

interface SoireeRepositoryInterface
{
    /** @throws EntityNotFoundException */
    public function findById(int $id): Soiree;
}
