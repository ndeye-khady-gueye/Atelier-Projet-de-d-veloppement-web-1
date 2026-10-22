<?php
declare(strict_types=1);

namespace nrv\tests\core;

use nrv\core\application\exceptions\ServiceAuthException;
use nrv\core\application\exceptions\ServiceConflictException;
use nrv\core\application\exceptions\ServiceInvalidDataException;
use nrv\core\application\usecases\ServiceAuthentification;
use nrv\tests\fakes\FakeTokenManager;
use nrv\tests\fakes\InMemoryUtilisateurRepository;
use PHPUnit\Framework\TestCase;

final class ServiceAuthentificationTest extends TestCase
{
    private InMemoryUtilisateurRepository $repo;
    private ServiceAuthentification $service;

    protected function setUp(): void
    {
        $this->repo = new InMemoryUtilisateurRepository();
        $this->service = new ServiceAuthentification($this->repo, new FakeTokenManager());
    }

    public function testInscriptionCreeUnClientAvecMotDePasseHache(): void
    {
        $auth = $this->service->inscrire('Marc Dubois', ' Marc@Test.com ', 'motdepasse123');

        $this->assertSame('client', $auth->role);
        $this->assertSame('marc@test.com', $auth->email);
        $this->assertSame('1:client', $auth->token);
        $stocke = $this->repo->findById($auth->id)->passwordHash;
        $this->assertNotSame('motdepasse123', $stocke);
        $this->assertTrue(password_verify('motdepasse123', $stocke));
    }

    public function testEmailDejaUtilise(): void
    {
        $this->service->inscrire('A', 'a@test.com', 'motdepasse123');
        $this->expectException(ServiceConflictException::class);
        $this->service->inscrire('B', 'A@test.com', 'autremotdepasse');
    }

    public function testEmailInvalide(): void
    {
        $this->expectException(ServiceInvalidDataException::class);
        $this->service->inscrire('A', 'pas-un-email', 'motdepasse123');
    }

    public function testMotDePasseTropCourt(): void
    {
        $this->expectException(ServiceInvalidDataException::class);
        $this->service->inscrire('A', 'a@test.com', 'court');
    }

    public function testConnexion(): void
    {
        $this->service->inscrire('Marc', 'marc@test.com', 'motdepasse123');
        $this->assertSame('1:client', $this->service->connecter('marc@test.com', 'motdepasse123')->token);
    }

    public function testConnexionMauvaisMotDePasse(): void
    {
        $this->service->inscrire('Marc', 'marc@test.com', 'motdepasse123');
        $this->expectException(ServiceAuthException::class);
        $this->service->connecter('marc@test.com', 'mauvais');
    }

    public function testConnexionEmailInconnu(): void
    {
        $this->expectException(ServiceAuthException::class);
        $this->service->connecter('inconnu@test.com', 'motdepasse123');
    }

    public function testVerifierToken(): void
    {
        $u = $this->service->verifierToken('3:admin');
        $this->assertSame(3, $u->id);
        $this->assertTrue($u->estAdmin());
    }
}
