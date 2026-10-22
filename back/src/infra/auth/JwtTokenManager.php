<?php
declare(strict_types=1);

namespace nrv\infra\auth;

use nrv\core\application\exceptions\ServiceAuthException;
use nrv\core\application\ports\spi\TokenManagerInterface;
use nrv\core\domain\entities\Utilisateur;

/**
 * Jetons JWT signés en HS256 (HMAC-SHA256) : header.payload.signature en base64url.
 * Le payload contient l'id (sub), le rôle et la date d'expiration (exp).
 */
class JwtTokenManager implements TokenManagerInterface
{
    public function __construct(
        private string $secret,
        private int $dureeSecondes = 14400
    ) {
        if (strlen($secret) < 16) {
            throw new \InvalidArgumentException('Secret JWT trop court (16 caractères minimum)');
        }
    }

    public function creer(Utilisateur $utilisateur): string
    {
        $header = self::b64(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $payload = self::b64(json_encode([
            'sub' => $utilisateur->id,
            'role' => $utilisateur->role,
            'iat' => time(),
            'exp' => time() + $this->dureeSecondes,
        ]));
        return "$header.$payload." . $this->signer("$header.$payload");
    }

    public function verifier(string $token): array
    {
        $parties = explode('.', $token);
        if (count($parties) !== 3) {
            throw new ServiceAuthException('Jeton invalide');
        }
        [$header, $payload, $signature] = $parties;
        if (!hash_equals($this->signer("$header.$payload"), $signature)) {
            throw new ServiceAuthException('Jeton invalide');
        }
        $h = json_decode(self::b64d($header), true);
        $p = json_decode(self::b64d($payload), true);
        if (($h['alg'] ?? null) !== 'HS256' || !is_array($p) || !isset($p['sub'], $p['role'], $p['exp'])) {
            throw new ServiceAuthException('Jeton invalide');
        }
        if ($p['exp'] < time()) {
            throw new ServiceAuthException('Jeton expiré : reconnectez-vous');
        }
        return ['id' => (int) $p['sub'], 'role' => (string) $p['role']];
    }

    private function signer(string $donnees): string
    {
        return self::b64(hash_hmac('sha256', $donnees, $this->secret, true));
    }

    private static function b64(string $s): string
    {
        return rtrim(strtr(base64_encode($s), '+/', '-_'), '=');
    }

    private static function b64d(string $s): string
    {
        return (string) base64_decode(strtr($s, '-_', '+/'), true);
    }
}
