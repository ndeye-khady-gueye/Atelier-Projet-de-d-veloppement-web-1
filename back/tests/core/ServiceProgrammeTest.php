<?php
declare(strict_types=1);

namespace nrv\tests\core;

use DateTimeImmutable;
use nrv\core\application\dto\FiltreSpectaclesDTO;
use nrv\core\application\exceptions\ServiceInvalidDataException;
use nrv\core\application\exceptions\ServiceNotFoundException;
use nrv\core\application\usecases\ServiceProgramme;
use nrv\core\domain\entities\GrilleTarifaire;
use nrv\core\domain\entities\Lieu;
use nrv\core\domain\entities\Soiree;
use nrv\core\domain\entities\Spectacle;
use nrv\core\domain\entities\Style;
use nrv\tests\fakes\InMemorySoireeRepository;
use nrv\tests\fakes\InMemorySpectacleRepository;
use nrv\tests\fakes\InMemoryStyleRepository;
use PHPUnit\Framework\TestCase;

final class ServiceProgrammeTest extends TestCase
{
    private ServiceProgramme $service;

    protected function setUp(): void
    {
        $blues = new Style(1, 'blues rock');
        $metal = new Style(2, 'métal');
        $lieu = new Lieu(1, 'Zénith de Nancy', 'Rue du Zénith, Maxéville', 100);

        $soirees = [
            new Soiree(1, 'Blues Night', 'soirée blues', new DateTimeImmutable('2027-06-12 20:00'), $lieu, 40),
            new Soiree(2, 'Metal Storm', 'soirée métal', new DateTimeImmutable('2027-06-13 19:30'), $lieu, 100),
        ];
        $spectacles = [
            new Spectacle(1, 'Delta Roots', 'desc', null, new DateTimeImmutable('2027-06-12 20:30'), $blues, 1, ['A'], ['1.jpg']),
            new Spectacle(2, 'Chicago Fire', 'desc', null, new DateTimeImmutable('2027-06-12 22:00'), $blues, 1, ['B'], []),
            new Spectacle(3, 'Iron Veins', 'desc', 'https://v', new DateTimeImmutable('2027-06-13 20:00'), $metal, 2),
        ];

        $this->service = new ServiceProgramme(
            new InMemorySpectacleRepository($spectacles),
            new InMemorySoireeRepository($soirees),
            new InMemoryStyleRepository([$blues, $metal]),
            new GrilleTarifaire(30.0, 20.0, 0.03)
        );
    }

    public function testListeSansFiltreRetourneTousLesSpectaclesTries(): void
    {
        $page = $this->service->listerSpectacles(new FiltreSpectaclesDTO());

        $this->assertSame(3, $page->total);
        $this->assertSame(['Delta Roots', 'Chicago Fire', 'Iron Veins'], array_map(fn ($s) => $s->titre, $page->spectacles));
        $this->assertSame('2027-06-12', $page->spectacles[0]->date);
        $this->assertSame('20:30', $page->spectacles[0]->horaire);
        $this->assertSame('1.jpg', $page->spectacles[0]->image);
    }

    public function testFiltreParDate(): void
    {
        $page = $this->service->listerSpectacles(new FiltreSpectaclesDTO(date: '2027-06-13'));

        $this->assertSame(1, $page->total);
        $this->assertSame('Iron Veins', $page->spectacles[0]->titre);
    }

    public function testFiltreParStyle(): void
    {
        $page = $this->service->listerSpectacles(new FiltreSpectaclesDTO(styleId: '1'));

        $this->assertSame(2, $page->total);
    }

    public function testFiltresDateEtStyleCombines(): void
    {
        $page = $this->service->listerSpectacles(new FiltreSpectaclesDTO(date: '2027-06-13', styleId: '1'));

        $this->assertSame(0, $page->total);
        $this->assertSame([], $page->spectacles);
    }

    public function testPagination(): void
    {
        $page = $this->service->listerSpectacles(new FiltreSpectaclesDTO(page: '2', taille: 2));

        $this->assertSame(2, $page->nbPages());
        $this->assertCount(1, $page->spectacles);
        $this->assertTrue($page->aPrecedente());
        $this->assertFalse($page->aSuivante());
    }

    public function testDateInvalideEstRefusee(): void
    {
        $this->expectException(ServiceInvalidDataException::class);
        $this->service->listerSpectacles(new FiltreSpectaclesDTO(date: '2027-02-30'));
    }

    public function testStyleNonNumeriqueEstRefuse(): void
    {
        $this->expectException(ServiceInvalidDataException::class);
        $this->service->listerSpectacles(new FiltreSpectaclesDTO(styleId: "1 OR 1=1"));
    }

    public function testDetailSoiree(): void
    {
        $soiree = $this->service->afficherSoiree(1);

        $this->assertSame('Blues Night', $soiree->nom);
        $this->assertSame('20:00', $soiree->horaire);
        $this->assertSame(60, $soiree->placesRestantes);
        $this->assertCount(2, $soiree->spectacles);
        $this->assertSame(['A'], $soiree->spectacles[0]->artistes);
        $this->assertSame(30.0, $soiree->tarifs['normal']);
        $this->assertSame(87.3, $soiree->tarifs['pass_normal']);
    }

    public function testSoireeCompleteN_aPlusDePlaces(): void
    {
        $this->assertSame(0, $this->service->afficherSoiree(2)->placesRestantes);
    }

    public function testSoireeInexistante(): void
    {
        $this->expectException(ServiceNotFoundException::class);
        $this->service->afficherSoiree(99);
    }

    public function testListeDesSoireesAvecPlacesRestantes(): void
    {
        $soirees = $this->service->listerSoirees();

        $this->assertCount(2, $soirees);
        $this->assertSame('Blues Night', $soirees[0]->nom);
        $this->assertSame(60, $soirees[0]->placesRestantes);
        $this->assertTrue($soirees[1]->toArray()['complet']);
    }

    public function testListeDesStyles(): void
    {
        $styles = $this->service->listerStyles();

        $this->assertCount(2, $styles);
        $this->assertSame('blues rock', $styles[0]->libelle);
    }
}
