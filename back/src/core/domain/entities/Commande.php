<?php
declare(strict_types=1);

namespace nrv\core\domain\entities;

use DateTimeImmutable;

final class Commande
{
    public const EN_ATTENTE = 'en_attente';
    public const PAYEE = 'payee';

    /** @param LigneCommande[] $lignes */
    public function __construct(
        public readonly ?int $id,
        public readonly int $utilisateurId,
        public readonly DateTimeImmutable $date,
        public readonly float $montant,
        public readonly string $statut,
        public readonly array $lignes
    ) {
    }

    public function estPayee(): bool
    {
        return $this->statut === self::PAYEE;
    }

    /** @return array<int, int> nombre de billets par soirée */
    public function billetsParSoiree(): array
    {
        $n = [];
        foreach ($this->lignes as $l) {
            $n[$l->soireeId] = ($n[$l->soireeId] ?? 0) + $l->quantite;
        }
        return $n;
    }
}
