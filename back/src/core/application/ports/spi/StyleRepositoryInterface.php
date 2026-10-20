<?php
declare(strict_types=1);

namespace nrv\core\application\ports\spi;

use nrv\core\domain\entities\Style;

interface StyleRepositoryInterface
{
    /** @return Style[] */
    public function findAll(): array;
}
