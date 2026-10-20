-- NRV.net - schéma PostgreSQL (brouillon proposé par A, à valider et compléter par C)
-- Les noms de tables et de colonnes sont ceux utilisés par les repositories PDO du backend.

DROP TABLE IF EXISTS billet, ligne_panier, panier, commande, utilisateur,
    image, spectacle_artiste, artiste, spectacle, soiree, style, lieu CASCADE;

CREATE TABLE lieu (
    id        SERIAL PRIMARY KEY,
    nom       VARCHAR(128) NOT NULL,
    adresse   VARCHAR(256) NOT NULL,
    nb_places INTEGER NOT NULL CHECK (nb_places > 0)
);

CREATE TABLE style (
    id      SERIAL PRIMARY KEY,
    libelle VARCHAR(64) NOT NULL UNIQUE
);

CREATE TABLE soiree (
    id             SERIAL PRIMARY KEY,
    nom            VARCHAR(128) NOT NULL,
    thematique     VARCHAR(128) NOT NULL,
    date_debut     TIMESTAMP NOT NULL,           -- date + horaire de début
    lieu_id        INTEGER NOT NULL REFERENCES lieu(id),
    places_vendues INTEGER NOT NULL DEFAULT 0 CHECK (places_vendues >= 0)
);

CREATE TABLE spectacle (
    id                   SERIAL PRIMARY KEY,
    titre                VARCHAR(128) NOT NULL,
    description          TEXT NOT NULL,
    url_video            VARCHAR(512),
    horaire_previsionnel TIMESTAMP NOT NULL,
    style_id             INTEGER NOT NULL REFERENCES style(id),
    soiree_id            INTEGER NOT NULL REFERENCES soiree(id) ON DELETE CASCADE
);

CREATE TABLE artiste (
    id  SERIAL PRIMARY KEY,
    nom VARCHAR(128) NOT NULL
);

CREATE TABLE spectacle_artiste (
    spectacle_id INTEGER NOT NULL REFERENCES spectacle(id) ON DELETE CASCADE,
    artiste_id   INTEGER NOT NULL REFERENCES artiste(id) ON DELETE CASCADE,
    PRIMARY KEY (spectacle_id, artiste_id)
);

CREATE TABLE image (
    id           SERIAL PRIMARY KEY,
    url          VARCHAR(512) NOT NULL,
    spectacle_id INTEGER NOT NULL REFERENCES spectacle(id) ON DELETE CASCADE
);

-- ---- achat (utilisé à partir de mercredi) ----

CREATE TABLE utilisateur (
    id            SERIAL PRIMARY KEY,
    nom           VARCHAR(128) NOT NULL,
    email         VARCHAR(256) NOT NULL UNIQUE,
    password_hash VARCHAR(256) NOT NULL,
    role          VARCHAR(16) NOT NULL DEFAULT 'client' CHECK (role IN ('client', 'admin'))
);

CREATE TABLE panier (
    id             SERIAL PRIMARY KEY,
    utilisateur_id INTEGER NOT NULL UNIQUE REFERENCES utilisateur(id) ON DELETE CASCADE
);

CREATE TABLE ligne_panier (
    id        SERIAL PRIMARY KEY,
    panier_id INTEGER NOT NULL REFERENCES panier(id) ON DELETE CASCADE,
    soiree_id INTEGER NOT NULL REFERENCES soiree(id),
    categorie VARCHAR(16) NOT NULL CHECK (categorie IN ('normal', 'reduit')),
    quantite  INTEGER NOT NULL CHECK (quantite > 0),
    pass_id   VARCHAR(36)                        -- même valeur pour les 3 lignes d'un pass 3 jours
);

CREATE TABLE commande (
    id             SERIAL PRIMARY KEY,
    utilisateur_id INTEGER NOT NULL REFERENCES utilisateur(id),
    date_commande  TIMESTAMP NOT NULL DEFAULT NOW(),
    montant_total  NUMERIC(8, 2) NOT NULL,
    statut         VARCHAR(16) NOT NULL DEFAULT 'en_attente' CHECK (statut IN ('en_attente', 'payee'))
);

CREATE TABLE billet (
    id          SERIAL PRIMARY KEY,
    commande_id INTEGER NOT NULL REFERENCES commande(id) ON DELETE CASCADE,
    soiree_id   INTEGER NOT NULL REFERENCES soiree(id),
    reference   VARCHAR(32) NOT NULL UNIQUE,
    categorie   VARCHAR(16) NOT NULL CHECK (categorie IN ('normal', 'reduit')),
    prix        NUMERIC(8, 2) NOT NULL,
    token       VARCHAR(64) NOT NULL UNIQUE      -- bin2hex(random_bytes(32))
);
