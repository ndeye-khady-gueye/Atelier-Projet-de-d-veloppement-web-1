<?php
declare(strict_types=1);

namespace nrv\core\application\dto;

use nrv\core\domain\entities\Commande;

final class CommandeDTO
{
    /** @param BilletDTO[] $billets */
    public function __construct(
        public readonly int $id,
        public readonly string $date,
        public readonly float $montant,
        public readonly string $statut,
        public readonly int $nbBillets,
        public readonly array $billets = []
    ) {
    }

    /** @param BilletDTO[] $billets */
    public static function fromEntity(Commande $c, array $billets = []): self
    {
        $nb = array_sum(array_map(fn ($l) => $l->quantite, $c->lignes));
        return new self((int) $c->id, $c->date->format('Y-m-d H:i'), $c->montant, $c->statut, $nb, $billets);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'montant' => $this->montant,
            'statut' => $this->statut,
            'nb_billets' => $this->nbBillets,
        ];
    }
}
