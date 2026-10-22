<?php
declare(strict_types=1);

namespace nrv\core\application\dto;

use DateTimeImmutable;

final class BilletDTO
{
    public function __construct(
        public readonly string $reference,
        public readonly string $token,
        public readonly string $acheteur,
        public readonly string $soiree,
        public readonly string $date,
        public readonly string $horaire,
        public readonly string $lieu,
        public readonly string $categorie,
        public readonly float $prix
    ) {
    }

    /** @param array{reference: string, token: string, categorie: string, prix: float|string, acheteur: string, soiree: string, debut: string, lieu: string, adresse: string} $b */
    public static function fromArray(array $b): self
    {
        $debut = new DateTimeImmutable($b['debut']);
        return new self(
            $b['reference'],
            $b['token'],
            $b['acheteur'],
            $b['soiree'],
            $debut->format('Y-m-d'),
            $debut->format('H:i'),
            $b['lieu'] . ', ' . $b['adresse'],
            $b['categorie'],
            (float) $b['prix']
        );
    }

    public function toArray(): array
    {
        return [
            'reference' => $this->reference,
            'acheteur' => $this->acheteur,
            'soiree' => ['nom' => $this->soiree, 'date' => $this->date, 'horaire' => $this->horaire, 'lieu' => $this->lieu],
            'categorie' => $this->categorie,
            'prix' => $this->prix,
        ];
    }
}
