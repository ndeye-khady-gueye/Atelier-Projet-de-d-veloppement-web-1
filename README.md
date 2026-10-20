# NRV.net – Billetterie du Festival Nancy Rock Vibration

Application web de billetterie en ligne pour le festival **Nancy Rock Vibration** (NRV), réalisée dans le cadre de la SAÉ « Atelier-Projet de développement web 1 » (BUT 3 Informatique DWM, IUT Nancy-Charlemagne).

**Groupe :** Ndeye Khady Gueye · Alejandro Villalobos Zaragoza · André Alan Vergara De Loera

| | URL |
|---|---|
| Application (front) | http://docketu.iutnc.univ-lorraine.fr:45002 |
| API | http://docketu.iutnc.univ-lorraine.fr:45000/spectacles |
| Adminer (base de données) | http://docketu.iutnc.univ-lorraine.fr:45001 |
| Dépôt git | https://github.com/ndeye-khady-gueye/Atelier-Projet-de-d-veloppement-web-1 |

---

## 🛠️ Architecture technique

* **Backend :** API RESTful / HATEOAS en **PHP 8.3 / Slim 4**, architecture hexagonale (dossier `back/`, voir `back/README.md`), PDO, PHP-DI, tests PHPUnit
* **Frontend :** **HTML5 / SCSS / JavaScript** (requêtes `fetch`, templates **Handlebars**), dossier `front/`
* **Base de données :** **PostgreSQL 16**, scripts dans `sql/`
* **Conteneurisation :** **Docker** et **Docker Compose** (4 services, tous avec `restart`)

| Service | Rôle | Port |
|---|---|---|
| `nrv.api` | API PHP/Slim (Apache), sert `back/public` | 45000 |
| `adminer` | Administration de la base | 45001 |
| `nrv.front` | Serveur web (nginx) de l'interface, sert `front/` | 45002 |
| `nrv.db` | PostgreSQL, réseau interne uniquement | — |

---

## ⚙️ Installation et lancement en local

### Prérequis
* [Docker Desktop](https://www.docker.com/) installé et démarré
* [Git](https://git-scm.com/)

### Étapes

1. **Cloner le dépôt :**
   ```bash
   git clone https://github.com/ndeye-khady-gueye/Atelier-Projet-de-d-veloppement-web-1.git
   cd Atelier-Projet-de-d-veloppement-web-1
   ```
2. **Créer la configuration de connexion à la base** (fichier non versionné) :
   ```bash
   cp back/config/nrv.db.ini.dist back/config/nrv.db.ini
   ```
   Sous Windows : `copy back\config\nrv.db.ini.dist back\config\nrv.db.ini`
3. **Démarrer les conteneurs :**
   ```bash
   docker compose up -d --build
   ```
   Au premier lancement, PostgreSQL crée la base avec `sql/schema.sql` puis la remplit avec `sql/data.sql`.
4. **Installer les dépendances PHP :**
   ```bash
   docker compose exec nrv.api composer install
   ```
5. **Ouvrir l'application :**
   * front : http://localhost:45002
   * API : http://localhost:45000/spectacles
   * Adminer : http://localhost:45001 (système *PostgreSQL*, serveur `nrv.db`, utilisateur `nrv`, mot de passe `changeme`, base `nrv`)

### Lancer les tests du backend
```bash
docker compose exec nrv.api vendor/bin/phpunit
```

### Recréer la base (après une modification de `sql/`)
PostgreSQL ne charge les scripts de `sql/` qu'à la première création de la base :
```bash
docker compose down -v      # supprime la base
docker compose up -d
```

---

## 🗃️ Données de test

`sql/data.sql` est généré avec **FakerPHP** par `sql/generate.php` :
12 soirées sur 2 semaines (10 au 23 juin 2027), 2 ou 3 spectacles par soirée (30 au total), 3 lieux, 6 styles, des artistes, des images et des utilisateurs de test.

```bash
cd sql
composer install
php generate.php
```

### Identifiants de test

| Rôle | Email | Mot de passe |
|---|---|---|
| Gestionnaire (back-office) | `admin@nrv.net` | `nrv2024` |
| Client | `client@test.com` | `nrv2024` |
| Client | `marc.dubois@test.com` | `nrv2024` |

La soirée « Clôture : Rock Party » est complète, pour tester l'affichage d'une soirée sans place disponible.

---

## 🚀 Déploiement sur docketu

Docker est installé en mode *rootless* sur docketu : chaque utilisateur a ses propres conteneurs.

### Première installation
```bash
ssh <login>@docketu.iutnc.univ-lorraine.fr
git clone https://github.com/ndeye-khady-gueye/Atelier-Projet-de-d-veloppement-web-1.git nrv
cd nrv

# secrets du serveur (jamais versionnés)
PASS=$(openssl rand -hex 16)
printf "NRV_DEBUG=0\nNRV_DB_PASSWORD=%s\n" "$PASS" > .env
chmod 600 .env
cp back/config/nrv.db.ini.dist back/config/nrv.db.ini
sed -i "s/^password = .*/password = $PASS/" back/config/nrv.db.ini

chmod +x deploy.sh
./deploy.sh
```

### Mises à jour
```bash
cd ~/nrv
./deploy.sh              # code uniquement
./deploy.sh --reset-db   # recrée aussi la base (efface les données)
```

> Sur docketu, `curl` passe par le proxy de l'IUT : pour tester l'API depuis le serveur, utiliser `curl --noproxy '*' http://localhost:45000/spectacles`.

---

## 📁 Organisation du dépôt

```
back/        API PHP/Slim (architecture hexagonale) + tests
front/       interface HTML/SCSS/JS ; front/mock/ = exemples de réponses de l'API
sql/         schema.sql, data.sql, generate.php (Faker)
docker/      Dockerfile de l'API
docs/        modèle du domaine, personas et scénarios
deploy.sh    script de déploiement sur docketu
```

Branches : `back`, `front`, `infra` (une par partie) ; `main` = version intégrée et déployée.
