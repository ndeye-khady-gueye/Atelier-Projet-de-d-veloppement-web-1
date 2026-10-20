<?php
declare(strict_types=1);

namespace nrv\tests\fakes;

use nrv\core\application\ports\spi\StyleRepositoryInterface;
use nrv\core\domain\entities\Style;

final class InMemoryStyleRepository implements StyleRepositoryInterface
{
    /** @param Style[] $styles */
    public function __construct(private array $styles)
    {
    }

    public function findAll(): array
    {
        return $this->styles;
    }
}
