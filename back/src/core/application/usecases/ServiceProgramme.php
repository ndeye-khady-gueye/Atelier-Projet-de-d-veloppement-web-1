<?php
declare(strict_types=1);

namespace nrv\core\application\usecases;

use DateTimeImmutable;
use nrv\core\application\dto\FiltreSpectaclesDTO;
use nrv\core\application\dto\PageSpectaclesDTO;
use nrv\core\application\dto\SoireeDTO;
use nrv\core\application\dto\SoireeResumeDTO;
use nrv\core\application\dto\SpectacleDetailDTO;
use nrv\core\application\dto\SpectacleDTO;
use nrv\core\application\dto\StyleDTO;
use nrv\core\application\exceptions\ServiceInvalidDataException;
use nrv\core\application\exceptions\ServiceNotFoundException;
use nrv\core\application\ports\api\ServiceProgrammeInterface;
use nrv\core\application\ports\spi\SoireeRepositoryInterface;
use nrv\core\application\ports\spi\SpectacleRepositoryInterface;
use nrv\core\application\ports\spi\StyleRepositoryInterface;
use nrv\core\domain\entities\GrilleTarifaire;
use nrv\core\domain\exceptions\EntityNotFoundException;

class ServiceProgramme implements ServiceProgrammeInterface
{
    public function __construct(
        private SpectacleRepositoryInterface $spectacleRepository,
        private SoireeRepositoryInterface $soireeRepository,
        private StyleRepositoryInterface $styleRepository,
        private GrilleTarifaire $grilleTarifaire
    ) {
    }

    public function listerSpectacles(FiltreSpectaclesDTO $filtre): PageSpectaclesDTO
    {
        $date = $this->validerDate($filtre->date);
        $styleId = $this->validerEntierPositif($filtre->styleId, 'style');
        $page = $this->validerEntierPositif($filtre->page, 'page') ?? 1;
        $taille = max(1, $filtre->taille);

        $total = $this->spectacleRepository->count($date, $styleId);
        $spectacles = $this->spectacleRepository->findAll($date, $styleId, ($page - 1) * $taille, $taille);

        return new PageSpectaclesDTO(
            array_map(fn ($s) => SpectacleDTO::fromEntity($s), $spectacles),
            $page,
            $taille,
            $total
        );
    }

    public function listerStyles(): array
    {
        return array_map(fn ($s) => StyleDTO::fromEntity($s), $this->styleRepository->findAll());
    }

    public function listerSoirees(): array
    {
        return array_map(fn ($s) => SoireeResumeDTO::fromEntity($s), $this->soireeRepository->findAll());
    }

    public function afficherSoiree(int $id): SoireeDTO
    {
        try {
            $soiree = $this->soireeRepository->findById($id);
        } catch (EntityNotFoundException) {
            throw new ServiceNotFoundException("Soirée $id introuvable");
        }
        $spectacles = array_map(
            fn ($s) => SpectacleDetailDTO::fromEntity($s),
            $this->spectacleRepository->findBySoiree($id)
        );
        return SoireeDTO::fromEntity($soiree, $this->grilleTarifaire, $spectacles);
    }

    private function validerDate(?string $date): ?DateTimeImmutable
    {
        if ($date === null || $date === '') {
            return null;
        }
        $d = DateTimeImmutable::createFromFormat('!Y-m-d', $date);
        if ($d === false || $d->format('Y-m-d') !== $date) {
            throw new ServiceInvalidDataException('Date invalide, format attendu : AAAA-MM-JJ');
        }
        return $d;
    }

    private function validerEntierPositif(?string $valeur, string $nom): ?int
    {
        if ($valeur === null || $valeur === '') {
            return null;
        }
        if (!ctype_digit($valeur) || (int) $valeur < 1) {
            throw new ServiceInvalidDataException("Paramètre « $nom » invalide : entier positif attendu");
        }
        return (int) $valeur;
    }
}
