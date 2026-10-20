<?php
declare(strict_types=1);

namespace nrv\core\application\ports\api;

use nrv\core\application\dto\FiltreSpectaclesDTO;
use nrv\core\application\dto\PageSpectaclesDTO;
use nrv\core\application\dto\SoireeDTO;
use nrv\core\application\dto\StyleDTO;
use nrv\core\application\exceptions\ServiceInvalidDataException;
use nrv\core\application\exceptions\ServiceNotFoundException;

interface ServiceProgrammeInterface
{
    /** @throws ServiceInvalidDataException */
    public function listerSpectacles(FiltreSpectaclesDTO $filtre): PageSpectaclesDTO;

    /** @return StyleDTO[] */
    public function listerStyles(): array;

    /** @throws ServiceNotFoundException */
    public function afficherSoiree(int $id): SoireeDTO;
}
