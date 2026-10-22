<?php
declare(strict_types=1);

use nrv\api\actions\ListerSpectaclesAction;
use nrv\api\middlewares\CorsMiddleware;
use nrv\core\application\ports\api\ServiceAuthentificationInterface;
use nrv\core\application\ports\api\ServiceBackofficeInterface;
use nrv\core\application\ports\api\ServiceCommandeInterface;
use nrv\core\application\ports\api\ServicePanierInterface;
use nrv\core\application\ports\api\ServiceProgrammeInterface;
use nrv\core\application\ports\spi\CommandeRepositoryInterface;
use nrv\core\application\ports\spi\PanierRepositoryInterface;
use nrv\core\application\ports\spi\SoireeRepositoryInterface;
use nrv\core\application\ports\spi\SpectacleRepositoryInterface;
use nrv\core\application\ports\spi\StyleRepositoryInterface;
use nrv\core\application\ports\spi\TokenManagerInterface;
use nrv\core\application\ports\spi\UtilisateurRepositoryInterface;
use nrv\core\application\usecases\ServiceAuthentification;
use nrv\core\application\usecases\ServiceBackoffice;
use nrv\core\application\usecases\ServiceCommande;
use nrv\core\application\usecases\ServicePanier;
use nrv\core\application\usecases\ServiceProgramme;
use nrv\core\domain\entities\GrilleTarifaire;
use nrv\infra\auth\JwtTokenManager;
use nrv\infra\repositories\PDOCommandeRepository;
use nrv\infra\repositories\PDOPanierRepository;
use nrv\infra\repositories\PDOSoireeRepository;
use nrv\infra\repositories\PDOSpectacleRepository;
use nrv\infra\repositories\PDOStyleRepository;
use nrv\infra\repositories\PDOUtilisateurRepository;
use Psr\Container\ContainerInterface;

return [
    // --- infrastructure ---
    PDO::class => function (ContainerInterface $c): PDO {
        $config = parse_ini_file($c->get('settings')['db.config']);
        if ($config === false) {
            throw new RuntimeException('Configuration de la base introuvable');
        }
        $dsn = sprintf(
            '%s:host=%s;port=%s;dbname=%s',
            $config['driver'],
            $config['host'],
            $config['port'],
            $config['database']
        );
        return new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    },

    // --- ports de sortie -> adaptateurs (inversion de dépendances) ---
    SpectacleRepositoryInterface::class => DI\autowire(PDOSpectacleRepository::class),
    SoireeRepositoryInterface::class => DI\autowire(PDOSoireeRepository::class),
    StyleRepositoryInterface::class => DI\autowire(PDOStyleRepository::class),
    UtilisateurRepositoryInterface::class => DI\autowire(PDOUtilisateurRepository::class),
    PanierRepositoryInterface::class => DI\autowire(PDOPanierRepository::class),
    CommandeRepositoryInterface::class => DI\autowire(PDOCommandeRepository::class),
    TokenManagerInterface::class => fn (ContainerInterface $c) => new JwtTokenManager(
        $c->get('settings')['jwt.secret'],
        (int) $c->get('settings')['jwt.duree']
    ),

    // --- domaine ---
    GrilleTarifaire::class => function (ContainerInterface $c): GrilleTarifaire {
        $t = $c->get('settings')['tarifs'];
        return new GrilleTarifaire($t['normal'], $t['reduit'], $t['remise_pass']);
    },

    // --- ports d'entrée -> services ---
    ServiceProgrammeInterface::class => DI\autowire(ServiceProgramme::class),
    ServiceAuthentificationInterface::class => DI\autowire(ServiceAuthentification::class),
    ServicePanierInterface::class => DI\autowire(ServicePanier::class),
    ServiceCommandeInterface::class => DI\autowire(ServiceCommande::class),
    ServiceBackofficeInterface::class => DI\autowire(ServiceBackoffice::class),

    // --- api ---
    ListerSpectaclesAction::class => fn (ContainerInterface $c) => new ListerSpectaclesAction(
        $c->get(ServiceProgrammeInterface::class),
        (int) $c->get('settings')['pagination.taille']
    ),
    CorsMiddleware::class => fn (ContainerInterface $c) =>
        new CorsMiddleware($c->get('settings')['cors.origin']),
];
