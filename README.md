### 🔑 Données de test et Accès

Les comptes de test pour le client et le gestionnaire sont configurés. 
De plus, les données générées sont très réalistes : 
- Les spectacles ont une vidéo YouTube intégrée selon leur style.
- Les places vendues correspondent à de vraies commandes payées (**92 commandes, 25 032 billets, 40 acheteurs fictifs**), ce qui garantit que les statistiques et la recette dans le back-office sont cohérentes.
- La soirée « Clôture : Rock Party » est complète, pour tester l'affichage d'une soirée sans place disponible.

| Rôle | Email | Mot de passe |
|---|---|---|
| Gestionnaire (back-office) | `admin@nrv.net` | `nrv2024` |
| Client | `client@test.com` | `nrv2024` |
| Client | `marc.dubois@test.com` | `nrv2024` |

**💳 Carte bancaire de test (pour la simulation de paiement) :**
- **Numéro :** `4111 1111 1111 1111`
- **Expiration :** `12/28` (une date passée sera refusée par l'API)
- **Code (CVC) :** `123`

## 🖥️ Pages du Front
*Pour les détails techniques de l'interface, consultez [front/README.md](front/README.md) écrit par André.*
- `index` : programme par spectacle
- `soirees` : programme par soirée
- `soiree` : détail d'une soirée
- `connexion` : page d'authentification
- `panier` : gestion des billets
- `pass` : achat du pass 3 jours
- `paiement` : simulation de paiement sécurisé
- `confirmation` et `billet` : affichage de l'E-billet imprimable
- `backoffice` : tableau de bord de gestion

## 🔌 Routes de l'API
- **Catalogue :** `GET /spectacles`, `GET /styles`, `GET /soirees`, `GET /soirees/{id}`
- **Authentification :** `POST /auth/register`, `POST /auth/signin`
- **Panier :** `GET /panier`, `POST /panier/lignes`, `POST /panier/pass`, `PATCH /panier/lignes/{id}`, `DELETE /panier/lignes/{id}`, `POST /panier/valider`
- **Commandes :** `GET /commandes/{id}`, `POST /commandes/{id}/paiement`, `GET /billets/{token}`
- **Gestionnaire :** `GET /admin/soirees`