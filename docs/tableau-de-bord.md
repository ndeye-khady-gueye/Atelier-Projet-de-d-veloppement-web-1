# Tableau de bord du projet NRV.net

SAÉ « Atelier-Projet de développement web 1 » · BUT 3 Informatique DWM · IUT Nancy-Charlemagne · 19-23 octobre 2026

**Groupe (3 personnes) :** Ndeye Khady Gueye · Alejandro Villalobos Zaragoza · André Alan Vergara De Loera

## 1. Accès

| | |
|---|---|
| Application (front) | http://docketu.iutnc.univ-lorraine.fr:45002 |
| API | http://docketu.iutnc.univ-lorraine.fr:45000 |
| Adminer | http://docketu.iutnc.univ-lorraine.fr:45001 |
| Dépôt git (public) | https://github.com/ndeye-khady-gueye/Atelier-Projet-de-d-veloppement-web-1 |
| Trello | https://trello.com/b/vGnLs8ry/projet-nrvnet |

docketu n'est accessible que depuis le réseau de l'IUT.

### Données de test

| Rôle | Email | Mot de passe |
|---|---|---|
| Gestionnaire (back-office) | `admin@nrv.net` | `nrv2024` |
| Client | `client@test.com` | `nrv2024` |
| Client | `marc.dubois@test.com` | `nrv2024` |

- Carte bancaire de test : n° `4111111111111111`, expiration `12/28` (toute date future), code `123`. Une date passée est refusée.
- 12 soirées du 10 au 23 juin 2027, 30 spectacles, 3 lieux, 6 styles. Chaque spectacle a des images et une vidéo.
- Les places déjà vendues correspondent à de vraies commandes payées (92 commandes, 25 032 billets, 40 acheteurs fictifs) : la jauge et la recette du back-office sont cohérentes.
- La soirée « Clôture : Rock Party » (23 juin) est complète : l'ajout au panier y est désactivé.

## 2. Fonctionnalités réalisées

### Fonctionnalités de base

| N° | Fonctionnalité | API | Page | État |
|---|---|---|---|---|
| 1 | Liste des spectacles (titre, date, horaire, image) | `GET /spectacles` | `index.html` | ✅ |
| 2 | Détail d'une soirée (nom, thématique, date, lieu, tarifs, spectacles avec artistes, description, style, vidéo) | `GET /soirees/{id}` | `soiree.html` | ✅ |
| 3 | Clic sur un spectacle : détail de sa soirée | lien HATEOAS `soiree` | `index.html` | ✅ |
| 4 | Filtre par date | `GET /spectacles?date=` | `index.html` | ✅ |
| 5 | Filtre par style | `GET /spectacles?style=`, `GET /styles` | `index.html` | ✅ |
| 6 | Ajout de billets au panier (tarif normal ou réduit) | `POST /panier/lignes` | `soiree.html` | ✅ |
| 7 | État du panier et montant total | `GET /panier` | `panier.html` | ✅ |
| 8 | Validation du panier en commande | `POST /panier/valider` | `panier.html` | ✅ |
| 9 | Paiement (n°, expiration, code) ; contrôle et mise à jour des places dans une transaction | `POST /commandes/{id}/paiement` | `paiement.html` | ✅ |
| 10 | Billets (acheteur, référence, date et horaire, tarif), URL avec jeton aléatoire, imprimables (`@media print`) | `GET /billets/{token}` | `confirmation.html`, `billet.html` | ✅ |
| 11 | Back-office : places vendues et recette de chaque soirée | `GET /admin/soirees` (rôle admin) | `backoffice.html` | ✅ |

### Fonctionnalités étendues

| N° | Fonctionnalité | Réalisation | État |
|---|---|---|---|
| 1 | Pagination de la liste des spectacles | `GET /spectacles?page=` avec liens `prev`/`next` | ✅ |
| 2 | Modification du nombre de billets dans le panier | `PATCH` / `DELETE /panier/lignes/{id}` | ✅ |
| 3 | Back-office : ajout de spectacles et de soirées | — | ❌ non réalisée |
| 4 | Vérification des places disponibles à l'ajout au panier | `409` si plus assez de places | ✅ |

### En plus du sujet

- Pass 3 jours : 3 soirées différentes avec 3 % de remise (`POST /panier/pass`, `GET /soirees`, page `pass.html`).
- Inscription et connexion, avec jeton JWT (`POST /auth/register`, `POST /auth/signin`).
- Après connexion, retour à la page où l'on était.
- Vue du programme par soirée (`soirees.html`) : date, lieu et places restantes, avec un sélecteur « Par spectacle / Par soirée ».
- Confirmation du mot de passe à l'inscription, case de justificatif pour le tarif réduit, message à la déconnexion.

## 3. Qualité et organisation

- **Architecture hexagonale :**
  - `api` : actions, middlewares, erreurs ;
  - `core` : domaine, services, DTO, ports ;
  - `infra` : dépôts PDO, JWT.
  - Les services dépendent d'interfaces, et l'injection de dépendances passe par PHP-DI.
- **Sécurité :**
  - requêtes préparées PDO ;
  - mots de passe hachés avec bcrypt ;
  - JWT signé HS256, valable 4 h ;
  - validation des données reçues ;
  - rôle admin vérifié par un middleware ;
  - secrets dans `.env`, non versionné.
- **Tests :**
  - 52 tests PHPUnit des services du domaine, avec des dépôts en mémoire ;
  - parcours complet testé dans un navigateur : achat, paiement, billet, pass, back-office.
- **Interface :**
  - SCSS mobile first, avec mixins (`from`, `flex`, `grille`, `cible-tactile`), flex et grid ;
  - les 10 pages sont validées W3C sans erreur (captures dans `docs/validations_w3c/`).
- **Déploiement :** Docker Compose avec 4 services sur docketu, et le script `deploy.sh`.
- **Git :** une branche par partie (`back`, `front`, `infra`) ; `main` est la version intégrée et déployée.

## 4. Contributions

| Membre | Rôle | Contributions |
|---|---|---|
| **Alejandro Villalobos Zaragoza** | Backend, intégration, déploiement | API Slim en architecture hexagonale (fonctionnalités 1 à 11, pass, authentification JWT), tests PHPUnit, JavaScript du front (fetch + Handlebars), intégration des branches dans `main`, corrections Docker/données, déploiement sur docketu, modèle du domaine |
| **André Alan Vergara De Loera** | Interface | Wireframes et maquettes, HTML et SCSS de toutes les pages (responsive, mobile first), design (logo, onglets Connexion/Inscription), validation W3C |
| **Ndeye Khady Gueye** | Infrastructure et documentation | Dépôt GitHub, configuration Docker et Composer, docker-compose, génération des données de test avec Faker, scripts de déploiement, README, personas et scénarios, Trello, tableau de bord |

### Documents rendus

- **Rendu intermédiaire (21/10) :** maquettes, personas et scénarios, modèle du domaine, version 1 de l'application.
- **Dans le dépôt :**
  - `README.md` ;
  - `docs/` : modèle du domaine, personas, wireframes, validations W3C, ce tableau de bord ;
  - `sql/` : schéma, données et générateur.
