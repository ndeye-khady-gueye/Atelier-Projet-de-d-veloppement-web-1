<?php
declare(strict_types=1);

namespace nrv\tests\core;

use InvalidArgumentException;
use nrv\core\domain\entities\GrilleTarifaire;
use PHPUnit\Framework\TestCase;

final class GrilleTarifaireTest extends TestCase
{
    public function testPrixParCategorie(): void
    {
        $g = new GrilleTarifaire(30.0, 20.0, 0.03);

        $this->assertSame(30.0, $g->prix(GrilleTarifaire::NORMAL));
        $this->assertSame(20.0, $g->prix(GrilleTarifaire::REDUIT));
    }

    public function testPassTroisJoursAvecRemiseDeTroisPourcent(): void
    {
        $g = new GrilleTarifaire(30.0, 20.0, 0.03);

        $this->assertSame(87.3, $g->prixPass(GrilleTarifaire::NORMAL));
        $this->assertSame(58.2, $g->prixPass(GrilleTarifaire::REDUIT));
    }

    public function testCategorieInconnue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new GrilleTarifaire(30.0, 20.0, 0.03))->prix('vip');
    }

    public function testTarifReduitSuperieurAuNormalRefuse(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new GrilleTarifaire(20.0, 30.0, 0.03);
    }
}
