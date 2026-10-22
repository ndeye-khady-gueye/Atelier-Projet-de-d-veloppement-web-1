<?php
declare(strict_types=1);

namespace nrv\core\application\usecases;

use nrv\core\application\dto\JaugeDTO;
use nrv\core\application\ports\api\ServiceBackofficeInterface;
use nrv\core\application\ports\spi\SoireeRepositoryInterface;

class ServiceBackoffice implements ServiceBackofficeInterface
{
    public function __construct(private SoireeRepositoryInterface $soireeRepository)
    {
    }

    public function jauges(): array
    {
        return array_map(fn ($j) => JaugeDTO::fromEntity($j), $this->soireeRepository->findAllJauges());
    }
}
