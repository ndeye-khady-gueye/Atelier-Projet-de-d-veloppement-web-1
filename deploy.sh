#!/bin/bash
# Script de déploiement de NRV.net sur docketu.iutnc.univ-lorraine.fr
#
# Usage (dans le dossier du projet sur docketu) :
#   ./deploy.sh            met à jour le code et redémarre l'application
#   ./deploy.sh --reset-db recrée aussi la base à partir de sql/ (EFFACE toutes les données)
#
# Pré-requis (une seule fois) : fichiers .env et back/config/nrv.db.ini créés (voir README).

set -e
cd "$(dirname "$0")"

echo "=== Déploiement NRV.net ==="

# 0. Vérification de la configuration locale (non versionnée)
for f in .env back/config/nrv.db.ini; do
    if [ ! -f "$f" ]; then
        echo "Erreur : $f est absent. Voir la section « Déploiement sur docketu » du README."
        exit 1
    fi
done

# 1. Récupération de la dernière version de la branche main
git checkout main
git pull origin main

# 2. Recréation de la base si demandé : PostgreSQL ne charge sql/schema.sql et sql/data.sql
#    qu'à la PREMIÈRE création du volume de données
if [ "$1" = "--reset-db" ]; then
    echo "Suppression de la base existante..."
    docker compose down -v
fi

# 3. (Re)construction et démarrage des conteneurs (restart: unless-stopped dans le compose)
docker compose up -d --build

# 4. Dépendances PHP de production (le conteneur doit être démarré pour « exec »)
docker compose exec -T nrv.api composer install --no-dev --optimize-autoloader

docker compose ps
echo "=== Déploiement terminé ==="
echo "API   : http://docketu.iutnc.univ-lorraine.fr:45000/spectacles"
echo "Front : http://docketu.iutnc.univ-lorraine.fr:45002"
