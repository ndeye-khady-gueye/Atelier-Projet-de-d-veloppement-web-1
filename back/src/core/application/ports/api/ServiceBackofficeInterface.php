<?php
declare(strict_types=1);

namespace nrv\core\application\ports\api;

use nrv\core\application\dto\JaugeDTO;

interface ServiceBackofficeInterface
{
    /** Fonctionnalité 11 : places vendues et recette de chaque soirée. @return JaugeDTO[] */
    public function jauges(): array;
}
