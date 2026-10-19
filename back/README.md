# NRV.net – backend (API PHP/Slim)

## Architecture hexagonale

```
src/
├── api/                      adaptateurs d'entrée (HTTP)
│   ├── actions/              une classe par route (__invoke)
│   ├── errors/               rendu JSON des erreurs
│   └── middlewares/          CORS
├── core/
│   ├── domain/               entités et exceptions métier
│   └── application/
│       ├── ports/api/        interfaces des services (utilisées par les actions)
│       ├── ports/spi/        interfaces des repositories (implémentées par infra)
│       ├── usecases/         services métier
│       ├── dto/              objets échangés avec l'api
│       └── exceptions/
└── infra/repositories/       adaptateurs de sortie (PDO)
config/                       settings, conteneur DI (dependencies.php), routes
tests/                        PHPUnit, repositories en mémoire (tests/fakes)
```

Le domaine ne dépend que de ses interfaces : `dependencies.php` associe chaque port à son adaptateur.

## Installation

```bash
cd back
composer install
cp config/nrv.db.ini.dist config/nrv.db.ini   # puis adapter
vendor/bin/phpunit                             # tests
```

Base : `sql/schema.sql` puis `sql/data-dev.sql` (ou le `data.sql` Faker).

## Routes disponibles

| Méthode | Route | Description |
| --- | --- | --- |
| GET | `/` | Point d'entrée, liens |
| GET | `/spectacles?date=AAAA-MM-JJ&style={id}&page={n}` | Liste filtrée et paginée |
| GET | `/styles` | Styles musicaux |
| GET | `/soirees/{id}` | Détail d'une soirée, tarifs et spectacles |

Erreurs : `{ "type": "error", "code": 400|404|500, "message": "..." }`.
Les exemples exacts des réponses sont dans `front/mock/`.
