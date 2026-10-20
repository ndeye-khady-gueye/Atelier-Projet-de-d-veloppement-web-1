#!/bin/bash
# Script de déploiement automatique sur le serveur docketu

echo "=== Début du déploiement NRV.net ==="

# 1. Récupération des dernières modifications sur la branche main
git checkout main
git pull origin main

# 2. Installation / Mise à jour des dépendances Composer dans le conteneur API
docker compose exec -T nrv.api composer install --no-dev --optimize-autoloader

# 3. Redémarrage des conteneurs avec rebuild si nécessaire
docker compose up -d --build

echo "=== Déploiement terminé avec succès ! ==="