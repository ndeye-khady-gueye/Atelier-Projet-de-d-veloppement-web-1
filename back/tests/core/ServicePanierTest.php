<?php
declare(strict_types=1);

namespace nrv\tests\core;

use DateTimeImmutable;
use nrv\core\application\exceptions\ServiceConflictException;
use nrv\core\application\exceptions\ServiceInvalidDataException;
use nrv\core\application\exceptions\ServiceNotFoundException;
use nrv\core\application\usecases\ServicePanier;
use nrv\core\domain\entities\GrilleTarifaire;
use nrv\core\domain\entities\Lieu;
use nrv\core\domain\entities\Soiree;
use nrv\tests\fakes\InMemoryCommandeRepository;
use nrv\tests\fakes\InMemoryPanierRepository;
use nrv\tests\fakes\InMemorySoireeRepository;
use PHPUnit\Framework\TestCase;

final class ServicePanierTest extends TestCase
{
    private const MARC = 1;
    private const LEA = 2;
    private ServicePanier $service;
    private InMemoryCommandeRepository $commandes;

    protected function setUp(): void
    {
        $salle = new Lieu(1, "L'Autre Canal", 'Nancy', 100);
        $soirees = new InMemorySoireeRepository([
            new Soiree(1, 'Blues Night', 'blues', new DateTimeImmutable('2027-06-11 20:00'), $salle, 95),
            new Soiree(2, 'Metal Storm', 'métal', new DateTimeImmutable('2027-06-12 20:00'), $salle, 100),
            new Soiree(3, 'Punk Attitude', 'punk', new DateTimeImmutable('2027-06-16 20:00'), $salle, 0),
            new Soiree(4, 'Rock Revival', 'rock', new DateTimeImmutable('2027-06-18 20:00'), $salle, 0),
        ]);
        $this->commandes = new InMemoryCommandeRepository();
        $this->service = new ServicePanier(
            new InMemoryPanierRepository($soirees),
            $soirees,
            $this->commandes,
            new GrilleTarifaire(30.0, 20.0, 0.03)
        );
    }

    public function testAjouterCalculeLeTotal(): void
    {
        $this->service->ajouterBillets(self::MARC, 1, 'normal', 2);
        $panier = $this->service->ajouterBillets(self::MARC, '4', 'reduit', '1');

        $this->assertSame(3, $panier->nbBillets);
        $this->assertSame(80.0, $panier->montantTotal);
        $this->assertSame(30.0, $panier->lignes[0]->prixUnitaire);
        $this->assertSame(60.0, $panier->lignes[0]->sousTotal);
    }

    public function testMemeSoireeEtTarifRegroupes(): void
    {
        $this->service->ajouterBillets(self::MARC, 1, 'normal', 1);
        $panier = $this->service->ajouterBillets(self::MARC, 1, 'normal', 2);

        $this->assertCount(1, $panier->lignes);
        $this->assertSame(3, $panier->lignes[0]->quantite);
    }

    public function testPlacesRestantesControleesALAjout(): void
    {
        $this->service->ajouterBillets(self::MARC, 1, 'normal', 5);   // 5 places restantes
        $this->expectException(ServiceConflictException::class);
        $this->service->ajouterBillets(self::MARC, 1, 'reduit', 1);
    }

    public function testSoireeComplete(): void
    {
        $this->expectException(ServiceConflictException::class);
        $this->service->ajouterBillets(self::MARC, 2, 'normal', 1);
    }

    public function testCategorieInvalide(): void
    {
        $this->expectException(ServiceInvalidDataException::class);
        $this->service->ajouterBillets(self::MARC, 1, 'vip', 1);
    }

    public function testQuantiteInvalide(): void
    {
        $this->expectException(ServiceInvalidDataException::class);
        $this->service->ajouterBillets(self::MARC, 1, 'normal', 0);
    }

    public function testSoireeInconnue(): void
    {
        $this->expectException(ServiceNotFoundException::class);
        $this->service->ajouterBillets(self::MARC, 99, 'normal', 1);
    }

    public function testPassTroisJoursAvecRemise(): void
    {
        $panier = $this->service->ajouterPass(self::LEA, [1, 3, 4], 'reduit');

        $this->assertSame(3, $panier->nbBillets);
        $this->assertSame(58.2, $panier->montantTotal);       // 3 x 20 € - 3 %
        $this->assertNotNull($panier->lignes[0]->pass);
    }

    public function testPassSurDeuxFoisLaMemeSoiree(): void
    {
        $this->expectException(ServiceInvalidDataException::class);
        $this->service->ajouterPass(self::LEA, [1, 1, 4], 'normal');
    }

    public function testSupprimerUneLigneDePassSupprimeLePass(): void
    {
        $panier = $this->service->ajouterPass(self::LEA, [1, 3, 4], 'normal');
        $panier = $this->service->supprimerLigne(self::LEA, $panier->lignes[0]->id);

        $this->assertSame(0, $panier->nbBillets);
    }

    public function testModifierQuantite(): void
    {
        $panier = $this->service->ajouterBillets(self::MARC, 4, 'normal', 1);
        $panier = $this->service->modifierQuantite(self::MARC, $panier->lignes[0]->id, 4);

        $this->assertSame(120.0, $panier->montantTotal);
    }

    public function testUnUtilisateurNeTouchePasLePanierDUnAutre(): void
    {
        $panier = $this->service->ajouterBillets(self::MARC, 4, 'normal', 1);
        $this->expectException(ServiceNotFoundException::class);
        $this->service->supprimerLigne(self::LEA, $panier->lignes[0]->id);
    }

    public function testValiderCreeUneCommandeEtVideLePanier(): void
    {
        $this->service->ajouterBillets(self::MARC, 1, 'normal', 2);
        $commande = $this->service->valider(self::MARC);

        $this->assertSame('en_attente', $commande->statut);
        $this->assertSame(60.0, $commande->montant);
        $this->assertSame(2, $commande->nbBillets);
        $this->assertSame(0, $this->service->consulter(self::MARC)->nbBillets);
        $this->assertSame(30.0, $this->commandes->commandes[1]->lignes[0]->prixUnitaire);
    }

    public function testValiderPanierVide(): void
    {
        $this->expectException(ServiceInvalidDataException::class);
        $this->service->valider(self::MARC);
    }
}
