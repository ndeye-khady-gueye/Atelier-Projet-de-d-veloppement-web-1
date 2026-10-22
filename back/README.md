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

| Méthode | Route | Accès | Description |
| --- | --- | --- | --- |
| GET | `/` | public | Point d'entrée, liens |
| GET | `/spectacles?date=AAAA-MM-JJ&style={id}&page={n}` | public | Liste filtrée et paginée (fonct. 1, 4, 5) |
| GET | `/styles` | public | Styles musicaux |
| GET | `/soirees/{id}` | public | Détail d'une soirée, tarifs et spectacles (fonct. 2, 3) |
| POST | `/auth/register` | public | Inscription `{nom, email, password}` → jeton |
| POST | `/auth/signin` | public | Connexion `{email, password}` → jeton |
| GET | `/panier` | connecté | Panier et montant total (fonct. 7) |
| POST | `/panier/lignes` | connecté | Ajout `{soiree, categorie, quantite}` (fonct. 6, places contrôlées) |
| POST | `/panier/pass` | connecté | Pass 3 jours `{soirees: [a, b, c], categorie}` (−3 %) |
| PATCH | `/panier/lignes/{id}` | connecté | Modifier la quantité `{quantite}` (étendue) |
| DELETE | `/panier/lignes/{id}` | connecté | Supprimer une ligne (ou tout le pass) |
| POST | `/panier/valider` | connecté | Le panier devient une commande « en attente » (fonct. 8) |
| GET | `/commandes/{id}` | propriétaire | Commande et ses billets |
| POST | `/commandes/{id}/paiement` | propriétaire | Paiement simulé `{numero, expiration, code}` : places vérifiées et décomptées, billets créés (fonct. 9, 10) |
| GET | `/billets/{token}` | public (lien) | Billet imprimable (fonct. 10) |
| GET | `/admin/soirees` | gestionnaire | Jauge et recette de chaque soirée (fonct. 11) |

Routes protégées : en-tête `Authorization: Bearer <jeton>` (JWT HS256, valable 4 h, secret `NRV_JWT_SECRET`).

Erreurs : `{ "type": "error", "code": ..., "message": "..." }` — 400 données invalides, 401 non authentifié,
403 interdit, 404 introuvable, 409 conflit (email déjà utilisé, plus de places, commande déjà payée).
Les exemples exacts des réponses sont dans `front/mock/`.

## Sécurité

* Requêtes préparées PDO partout, paramètres validés dans les services (types, formats, bornes).
* Mots de passe hachés (`password_hash`), message identique si l'email ou le mot de passe est faux.
* Jetons signés (HMAC-SHA256), comparés en temps constant (`hash_equals`), avec expiration.
* Un utilisateur n'accède qu'à son panier et à ses commandes (sinon 404) ; back-office réservé au rôle `admin`.
* Paiement en une transaction : la mise à jour des places échoue si la capacité serait dépassée, et tout est annulé.
* Billets accessibles uniquement par un token aléatoire de 64 caractères (`random_bytes`).
