<?php
declare(strict_types=1);

namespace nrv\core\application\dto;

use nrv\core\domain\entities\GrilleTarifaire;
use nrv\core\domain\entities\Soiree;

final class SoireeDTO
{
    /** @param SpectacleDetailDTO[] $spectacles */
    public function __construct(
        public readonly int $id,
        public readonly string $nom,
        public readonly string $thematique,
        public readonly string $date,
        public readonly string $horaire,
        public readonly array $lieu,
        public readonly array $tarifs,
        public readonly int $placesRestantes,
        public readonly array $spectacles
    ) {
    }

    /** @param SpectacleDetailDTO[] $spectacles */
    public static function fromEntity(Soiree $s, GrilleTarifaire $t, array $spectacles): self
    {
        return new self(
            $s->id,
            $s->nom,
            $s->thematique,
            $s->debut->format('Y-m-d'),
            $s->debut->format('H:i'),
            ['nom' => $s->lieu->nom, 'adresse' => $s->lieu->adresse],
            [
                'normal' => $t->prix(GrilleTarifaire::NORMAL),
                'reduit' => $t->prix(GrilleTarifaire::REDUIT),
                'pass_normal' => $t->prixPass(GrilleTarifaire::NORMAL),
                'pass_reduit' => $t->prixPass(GrilleTarifaire::REDUIT),
            ],
            $s->placesRestantes(),
            $spectacles
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'thematique' => $this->thematique,
            'date' => $this->date,
            'horaire' => $this->horaire,
            'lieu' => $this->lieu,
            'tarifs' => $this->tarifs,
            'places_restantes' => $this->placesRestantes,
            'complet' => $this->placesRestantes === 0,
        ];
    }
}
