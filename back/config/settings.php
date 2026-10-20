<?php
declare(strict_types=1);

return [
    'settings' => [
        'displayErrorDetails' => (bool) (getenv('NRV_DEBUG') ?: false),
        // fichier de connexion à la base, hors du dépôt git (voir nrv.db.ini.dist)
        'db.config' => getenv('NRV_DB_CONFIG') ?: __DIR__ . '/nrv.db.ini',
        'cors.origin' => getenv('NRV_CORS_ORIGIN') ?: '*',
        'pagination.taille' => 12,
        // tarifs uniques pour toutes les soirées (à ajuster)
        'tarifs' => [
            'normal' => 30.00,
            'reduit' => 20.00,
            'remise_pass' => 0.03,
        ],
    ],
];
