<?php
declare(strict_types=1);

namespace nrv\tests\core;

use nrv\core\application\exceptions\ServiceAuthException;
use nrv\core\domain\entities\Utilisateur;
use nrv\infra\auth\JwtTokenManager;
use PHPUnit\Framework\TestCase;

final class JwtTokenManagerTest extends TestCase
{
    private const SECRET = 'secret-de-test-assez-long';

    public function testJetonValide(): void
    {
        $jwt = new JwtTokenManager(self::SECRET);
        $token = $jwt->creer(new Utilisateur(7, 'Sophie', 'admin@nrv.net', 'x', 'admin'));
        $this->assertSame(['id' => 7, 'role' => 'admin'], $jwt->verifier($token));
    }

    public function testJetonModifieRefuse(): void
    {
        $jwt = new JwtTokenManager(self::SECRET);
        [$h, , $s] = explode('.', $jwt->creer(new Utilisateur(7, 'Marc', 'm@t.com', 'x', 'client')));
        $faux = rtrim(strtr(base64_encode(json_encode(['sub' => 7, 'role' => 'admin', 'exp' => time() + 99])), '+/', '-_'), '=');
        $this->expectException(ServiceAuthException::class);
        $jwt->verifier("$h.$faux.$s");
    }

    public function testAutreSecretRefuse(): void
    {
        $token = (new JwtTokenManager(self::SECRET))->creer(new Utilisateur(1, 'M', 'm@t.com', 'x', 'client'));
        $this->expectException(ServiceAuthException::class);
        (new JwtTokenManager('un-autre-secret-tres-long'))->verifier($token);
    }

    public function testJetonExpire(): void
    {
        $jwt = new JwtTokenManager(self::SECRET, -10);
        $token = $jwt->creer(new Utilisateur(1, 'M', 'm@t.com', 'x', 'client'));
        $this->expectException(ServiceAuthException::class);
        $jwt->verifier($token);
    }
}
