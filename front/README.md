# NRV.net – Frontend (HTML / SCSS / JavaScript)

Interface web de la billetterie du festival **Nancy Rock Vibration**. Le client est un site statique (dossier `front/`) servi par nginx sur le port **45002** ; il lit les données de l'API (port 45000) avec `fetch` et les affiche avec des **templates Handlebars**.

Répartition du travail sur le front :

* **HTML sémantique, SCSS, maquettes, validation W3C** : André Alan Vergara De Loera
* **JavaScript (`fetch`, templates Handlebars) et API** : Alejandro Villalobos Zaragoza

## Structure du dossier

```
front/
├── *.html            9 pages (voir le tableau ci-dessous)
├── scss/             sources Sass (main.scss importe les autres fichiers)
│   ├── _variables    palette, espacements, points de rupture
│   ├── _mixins       from() [media query], flex(), grille(), cible-tactile()
│   ├── _base         reset, typographie, images fluides
│   ├── _layout       en-tête, menu, filtres, grilles de cartes, page soirée
│   ├── _components   cartes, champs, boutons, tarifs, messages
│   └── _pages        connexion (onglets), panier, billet, back-office, @media print
├── css/main.css      CSS compilé (versionné : nginx ne compile pas)
├── js/               scripts des pages + js/vendor/handlebars.min.js
├── img/spectacles/   images des spectacles
└── mock/             exemples de réponses de l'API (contrat entre front et back)
```

## Compiler le SCSS

Prérequis : [Node.js](https://nodejs.org/) (version LTS).

```bash
cd front
npm install          # installe sass (le dossier node_modules n'est pas versionné)
npm run build        # compile une fois : scss/main.scss -> css/main.css
npm run sass         # recompile à chaque modification (pendant le développement)
```

Après une modification de `scss/`, il faut **recompiler et versionner `css/main.css`**.

## Pages

| Page | Contenu | Fonctionnalités du sujet | Appels à l'API |
|---|---|---|---|
| `index.html` | Programme : liste des spectacles, filtres date et style, pagination | 1, 4, 5, étendue 1 | `GET /spectacles`, `GET /styles` |
| `soiree.html` | Détail d'une soirée (tarifs, lieu, spectacles) et ajout au panier | 2, 3, 6, étendue 4 | `GET /soirees/{id}`, `POST /panier/lignes` |
| `connexion.html` | Connexion et inscription (onglets) | accès à l'achat | `POST /auth/signin`, `POST /auth/register` |
| `panier.html` | Lignes du panier, quantités, total, validation | 7, 8, étendue 2 | `GET /panier`, `PATCH` et `DELETE /panier/lignes/{id}`, `POST /panier/valider` |
| `pass.html` | Pass 3 jours : choix de 3 soirées | tarifs pass | `GET /soirees`, `POST /panier/pass` |
| `paiement.html` | Paiement simulé (carte) | 9 | `GET /commandes/{id}`, `POST /commandes/{id}/paiement` |
| `confirmation.html` | Commande payée et liste des billets | 10 | `GET /commandes/{id}` |
| `billet.html` | Billet imprimable (`billet.html?token=…`) | 10 | `GET /billets/{token}` |
| `backoffice.html` | Jauge des soirées et recette (gestionnaire) | 11 | `GET /admin/soirees` |

Les pages `confirmation.html` et `pass.html` ne figurent pas dans les maquettes : elles découlent du déroulement de l'API (confirmation après le paiement, choix de 3 soirées pour le pass).

## Choix de conception

**Mobile first.** Le CSS de base est celui du mobile. Les media queries n'utilisent que `min-width`, via le mixin `from()`, et les points de rupture sont en `em` (ils suivent la taille de police de l'utilisateur) :

| Point de rupture | Valeur | Justification |
|---|---|---|
| `tablette` | 40em (≈ 640 px) | deux cartes d'environ 18 em tiennent côte à côte |
| `bureau` | 62em (≈ 992 px) | trois cartes côte à côte, page soirée sur deux colonnes |

**Grid ou Flexbox.**

* **Grid** pour les mises en page à deux dimensions : grille de cartes (1, 2 puis 3 colonnes), page soirée avec `grid-template-areas`, lignes du panier, jauges du back-office.
* **Flexbox** pour les éléments alignés sur un seul axe : en-tête, menu, barre de filtres (colonne sur mobile, ligne dès la tablette), pagination, onglets.

**Sass.** Variables (palette, espacements), 4 mixins personnels (`from`, `flex`, `grille`, `cible-tactile`), imbrication avec `&`, boucle `@each` pour les onglets, sélecteurs avancés (`:not(:last-child)`, `:focus-within`, `:focus-visible`, `:empty`, `[aria-current]`, `:checked ~`).

**Images et interactions.** Images fluides (`max-width: 100 %`, `aspect-ratio`, `object-fit`) dans des éléments `<picture>`. Cibles tactiles d'au moins 2,75 em de haut. Les effets au survol sont dans `@media (hover: hover)` pour ne pas se déclencher au toucher.

**Adaptation selon l'appareil.**

| Page | Mobile | Tablette (≥ 40em) | Bureau (≥ 62em) |
|---|---|---|---|
| Programme | filtres en colonne, 1 colonne de cartes | filtres sur une ligne, 2 colonnes | menu sur la même ligne que le logo, 3 colonnes |
| Soirée | 1 colonne | spectacles sur 2 colonnes | 2 colonnes : spectacles à gauche, tarifs et achat à droite |
| Panier | lignes empilées | ligne sur 4 colonnes | récapitulatif fixe à droite |
| Connexion | onglets pleine largeur | idem | formulaire centré |

**Onglets Connexion / Inscription.** Réalisés uniquement en CSS : un bouton radio caché par onglet, et le formulaire dont le radio est coché (`:checked`) est affiché. Aucun JavaScript, et la navigation au clavier (flèches) fonctionne.

**Impression du billet.** `@media print` masque l'en-tête, le pied de page et le bouton « Imprimer ».

**Accessibilité.** Un seul `h1` par page, `label` associé à chaque champ, `aria-current` dans le menu, `aria-live` sur les zones chargées en JavaScript, `role="alert"` sur les erreurs de l'API.

## Contrat entre HTML et JavaScript

Le JavaScript s'appuie sur certains éléments du HTML. Ne pas modifier sans accord :

* les attributs `id`, `name` et `data-…` ;
* les blocs `<script type="text/x-handlebars-template">` et ce qui se trouve entre `{{ }}` ;
* les balises `<script>` en bas de chaque page.

Les classes de style et les textes peuvent être modifiés librement. Chaque conteneur rempli par le JavaScript (`#liste-spectacles`, `#panier-lignes`, …) contient un message de chargement qui est remplacé par les données de l'API.

## Maquettes et validation

* **Maquettes** (mobile, tablette, ordinateur) : `docs/wireframes/`.
* **Validation W3C** : les 9 pages passent le validateur sans erreur (captures dans `docs/validations_w3c/`). `soiree.html` et `billet.html` affichent un seul avertissement, « Article lacks heading » : le titre est inséré par le template Handlebars, donc absent du fichier source.

## Pistes d'amélioration (non réalisées)

* Vue des soirées sur la page d'accueil (la liste actuelle montre les spectacles, mais l'achat se fait par soirée).
* Confirmation du mot de passe à l'inscription.
* Case à cocher justifiant le tarif réduit.
* Message de confirmation à la déconnexion.
* Boutons − / + pour la quantité, à la place du champ numérique.
