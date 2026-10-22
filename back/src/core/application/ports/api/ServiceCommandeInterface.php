<?php
declare(strict_types=1);

namespace nrv\core\application\ports\api;

use nrv\core\application\dto\BilletDTO;
use nrv\core\application\dto\CommandeDTO;

interface ServiceCommandeInterface
{
    public function consulter(int $utilisateurId, int $commandeId): CommandeDTO;

    /** Fonctionnalités 9 et 10 : paiement simulé, contrôle et décompte des places, création des billets. */
    public function payer(int $utilisateurId, int $commandeId, mixed $numero, mixed $expiration, mixed $code): CommandeDTO;

    public function billet(string $token): BilletDTO;
}
