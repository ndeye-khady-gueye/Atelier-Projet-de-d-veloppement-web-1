<?php
declare(strict_types=1);

namespace nrv\tests\core;

use DateTimeImmutable;
use nrv\core\application\exceptions\ServiceConflictException;
use nrv\core\application\exceptions\ServiceInvalidDataException;
use nrv\core\application\exceptions\ServiceNotFoundException;
use nrv\core\application\usecases\ServiceCommande;
use nrv\core\domain\entities\Commande;
use nrv\core\domain\entities\LigneCommande;
use nrv\tests\fakes\InMemoryCommandeRepository;
use PHPUnit\Framework\TestCase;

final class ServiceCommandeTest extends TestCase
{
    private const MARC = 1;
    private InMemoryCommandeRepository $repo;
    private ServiceCommande $service;

    protected function setUp(): void
    {
        $this->repo = new InMemoryCommandeRepository();
        $this->repo->creer(new Commande(null, self::MARC, new DateTimeImmutable(), 80.0, Commande::EN_ATTENTE, [
            new LigneCommande(1, 'normal', 2, 30.0),
            new LigneCommande(4, 'reduit', 1, 20.0),
        ]));
        $this->repo->placesRestantes = [1 => 10, 4 => 10];
        $this->service = new ServiceCommande($this->repo, new DateTimeImmutable('2026-10-22'));
    }

    private function payer(string $numero = '1234 5678 9012 3456', string $exp = '12/28', string $code = '123')
    {
        return $this->service->payer(self::MARC, 1, $numero, $exp, $code);
    }

    public function testPaiementCreeLesBilletsEtDecompteLesPlaces(): void
    {
        $commande = $this->payer();

        $this->assertSame('payee', $commande->statut);
        $this->assertCount(3, $commande->billets);
        $this->assertSame([1 => 8, 4 => 9], $this->repo->placesRestantes);
        $token = $this->repo->billets[1][0]->token;
        $this->assertMatchesRegularExpression('/^[0-9a-f]{64}$/', $token);
        $this->assertSame(30.0, $this->service->billet($token)->prix);
    }

    public function testTokensDesBilletsTousDifferents(): void
    {
        $this->payer();
        $tokens = array_map(fn ($b) => $b->token, $this->repo->billets[1]);
        $this->assertCount(3, array_unique($tokens));
    }

    public function testPlacesInsuffisantes(): void
    {
        $this->repo->placesRestantes[1] = 1;
        try {
            $this->payer();
            $this->fail('Exception attendue');
        } catch (ServiceConflictException) {
            $this->assertSame('en_attente', $this->repo->commandes[1]->statut);
            $this->assertSame([1 => 1, 4 => 10], $this->repo->placesRestantes);
        }
    }

    public function testDejaPayee(): void
    {
        $this->payer();
        $this->expectException(ServiceConflictException::class);
        $this->payer();
    }

    public function testCarteInvalide(): void
    {
        $this->expectException(ServiceInvalidDataException::class);
        $this->payer('1234');
    }

    public function testCarteExpiree(): void
    {
        $this->expectException(ServiceInvalidDataException::class);
        $this->payer(exp: '09/26');
    }

    public function testCarteValideJusquALaFinDuMois(): void
    {
        $this->assertSame('payee', $this->payer(exp: '10/26')->statut);
    }

    public function testCodeInvalide(): void
    {
        $this->expectException(ServiceInvalidDataException::class);
        $this->payer(code: '12a');
    }

    public function testCommandeDUnAutreUtilisateurInvisible(): void
    {
        $this->expectException(ServiceNotFoundException::class);
        $this->service->consulter(2, 1);
    }

    public function testBilletInconnu(): void
    {
        $this->expectException(ServiceNotFoundException::class);
        $this->service->billet(str_repeat('a', 64));
    }
}
