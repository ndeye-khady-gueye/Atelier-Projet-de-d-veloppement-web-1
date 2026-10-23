<?php
/**
 * NRV.net - génération du jeu de données de test (FakerPHP)
 *
 * Usage (depuis le dossier sql/) :
 *   composer install
 *   php generate.php        -> écrit sql/data.sql
 *
 * Le festival dure 2 semaines (10 au 23 juin 2027) : 12 soirées, 2 ou 3 spectacles
 * par soirée (30 au total), des artistes, des images et des utilisateurs de test.
 * La graine fixe rend le fichier identique à chaque génération.
 */
require_once __DIR__ . '/vendor/autoload.php';

use Faker\Factory;

$faker = Factory::create('fr_FR');
$faker->seed(2027);
mt_srand(2027);

/** Chaîne SQL : les apostrophes sont doublées (norme SQL / PostgreSQL). */
function q(?string $s): string
{
    return $s === null ? 'NULL' : "'" . str_replace("'", "''", $s) . "'";
}

$sql = "-- Données de test NRV.net, générées par sql/generate.php (FakerPHP, graine 2027)\n";
$sql .= "-- Ne pas modifier à la main : relancer php generate.php\n\n";

// 1. LIEUX (id => capacité)
$lieux = [
    1 => ['Zénith de Nancy', 'Rue du Zénith, 54320 Maxéville', 6000],
    2 => ["L'Autre Canal", "45 boulevard d'Austrasie, 54000 Nancy", 1200],
    3 => ['Parc de la Pépinière', 'Place Boffrand, 54000 Nancy', 3000],
];
$sql .= "-- 1. Lieux\nINSERT INTO lieu (nom, adresse, nb_places) VALUES\n";
$sql .= implode(",\n", array_map(fn ($l) => "(" . q($l[0]) . ", " . q($l[1]) . ", {$l[2]})", $lieux)) . ";\n\n";

// 2. STYLES (id dans l'ordre d'insertion)
$styles = [1 => 'blues rock', 2 => 'classic rock', 3 => 'métal', 4 => 'chanson', 5 => 'hard rock', 6 => 'punk'];
$sql .= "-- 2. Styles\nINSERT INTO style (libelle) VALUES\n";
$sql .= implode(",\n", array_map(fn ($s) => "(" . q($s) . ")", $styles)) . ";\n\n";

// 3. SOIRÉES : date, nom, thématique, style principal, lieu, nb de spectacles
$soirees = [
    ['2027-06-10', 'Ouverture : Legends of Rock', 'Les grands classiques du rock', 2, 1, 3],
    ['2027-06-11', 'Blues Night', 'Blues du delta et de Chicago', 1, 2, 2],
    ['2027-06-12', 'Metal Storm', 'Heavy et thrash métal', 3, 1, 3],
    ['2027-06-13', 'Chansons Électriques', 'La chanson française version rock', 4, 3, 2],
    ['2027-06-15', 'Hard Rock Fever', 'Riffs et guitares saturées', 5, 2, 3],
    ['2027-06-16', 'Punk Attitude', 'Punk rock et énergie brute', 6, 2, 2],
    ['2027-06-17', 'Blues & Soul Session', 'Le blues rencontre la soul', 1, 3, 3],
    ['2027-06-18', 'Classic Rock Revival', 'Le rock des années 70 et 80', 2, 3, 2],
    ['2027-06-19', 'Nuit du Métal', 'Métal mélodique et symphonique', 3, 1, 3],
    ['2027-06-20', 'Rock en Français', 'Les voix de la scène française', 4, 2, 2],
    ['2027-06-22', 'Heavy Night', 'Hard rock et heavy métal', 5, 1, 3],
    ['2027-06-23', 'Clôture : Rock Party', 'Grande soirée de clôture tous styles', 2, 1, 2],
];
$sql .= "-- 3. Soirées\nINSERT INTO soiree (nom, thematique, date_debut, lieu_id, places_vendues) VALUES\n";
$rows = [];
$placesVendues = [];   // id soirée => places vendues (servent aux ventes de la partie 9)
foreach ($soirees as $i => [$date, $nom, $theme, $style, $lieu, $nb]) {
    $capacite = $lieux[$lieu][2];
    // la soirée de clôture est complète (pour tester l'affichage « complet ») ; les autres entre 10 % et 90 %
    $vendues = $i === 11 ? $capacite : (int) round($capacite * mt_rand(10, 90) / 100);
    $rows[] = "(" . q($nom) . ", " . q($theme) . ", " . q("$date 20:00:00") . ", $lieu, $vendues)";
    $placesVendues[$i + 1] = $vendues;
}
$sql .= implode(",\n", $rows) . ";\n\n";

// 4. SPECTACLES : 2 ou 3 par soirée, à 20:00, 21:30, 23:00
$groupes = [
    1 => ['Delta Roots', 'Chicago Fire', 'Muddy Road', 'Blue Lantern', 'The Crossroads Band', 'Smokin\' Harp', 'Bayou Kings', 'Whiskey Train'],
    2 => ['Back to 70s', 'Stone Highway', 'The Velvet Riders', 'Golden Vinyl', 'Rolling Thunder Revue', 'Electric Avenue', 'Silver Lining', 'The Long Road'],
    3 => ['Iron Veins', 'Black Anvil', 'Forge of Souls', 'Nordic Hammer', 'Crimson Abyss', 'Steel Prophecy', 'Dark Meridian', 'Titan Fall'],
    4 => ['Les Mots Bleus', 'Café Électrique', 'Les Enfants du Rock', 'Madame Fuzz', 'La Ligne Claire', 'Rue des Amplis', 'Les Nuits Fauves', 'Plein Volume'],
    5 => ['Thunder Riot', 'High Voltage Kings', 'Bad Reputation', 'Wild Engines', 'Red Lightning', 'Rock Bottom Riders', 'Loud Machine', 'Hell Riders'],
    6 => ['Les Rats Bruyants', 'No Future Club', 'Safety Pins', 'Crash Test', 'Les Sales Gosses', 'Anarchy Kitchen', 'Les Vandales', 'Pogo Club'],
];
$horaires = ['20:00:00', '21:30:00', '23:00:00'];
// style proche de chaque style (blues -> classic rock, métal -> hard rock, chanson -> classic rock...)
$stylesProches = [1 => 2, 2 => 5, 3 => 5, 4 => 2, 5 => 3, 6 => 5];
// descriptions : une phrase de présentation + une phrase sur le concert, selon le style
$presentations = [
    1 => ['revisite le blues du Mississippi avec une slide guitar brûlante', 'mêle harmonica, guitare électrique et voix rocailleuse'],
    2 => ['fait revivre les grands hymnes du rock des années 70', 'enchaîne riffs légendaires et solos interminables'],
    3 => ['déploie un métal puissant aux riffs martelés', 'associe double pédale, chœurs épiques et guitares acérées'],
    4 => ['porte des textes en français sur des guitares électriques', 'mélange chanson à texte et énergie rock'],
    5 => ['envoie un hard rock survolté hérité des grands noms du genre', 'aligne riffs saturés et refrains à reprendre en chœur'],
    6 => ['joue un punk rapide, court et sans concession', 'réveille l\'esprit punk avec des morceaux de deux minutes'],
];
$concerts = [
    'Un concert à ne pas manquer pour ouvrir la soirée.',
    'Le groupe présentera les titres de son nouvel album.',
    'Une prestation scénique réputée pour son énergie.',
    'Premier passage du groupe à Nancy.',
    'Un set d\'une heure qui promet de faire vibrer la salle.',
];
$villes = ['Nancy', 'Metz', 'Strasbourg', 'Lyon', 'Lille', 'Rennes', 'Bordeaux', 'Marseille', 'Toulouse', 'Nantes',
    'Bruxelles', 'Genève', 'Montréal', 'Londres', 'Chicago', 'Memphis', 'Stockholm', 'Berlin'];
$description = fn (string $titre, int $style) => $titre . ', groupe originaire de ' . $villes[mt_rand(0, count($villes) - 1)] . ', '
    . $presentations[$style][mt_rand(0, 1)] . '. ' . $concerts[mt_rand(0, count($concerts) - 1)];
// Une vidéo d'exemple par style (vrais clips officiels sur YouTube : les groupes du festival sont fictifs)
$videos = [
    1 => 'https://www.youtube.com/watch?v=a_426RiwST8',   // blues rock : The Black Keys - Lonely Boy
    2 => 'https://www.youtube.com/watch?v=fJ9rUzIMcZQ',   // classic rock : Queen - Bohemian Rhapsody
    3 => 'https://www.youtube.com/watch?v=CD-E-LDc384',   // métal : Metallica - Enter Sandman
    4 => 'https://www.youtube.com/watch?v=VHoT4N43jK8',   // chanson : Stromae - Alors on danse
    5 => 'https://www.youtube.com/watch?v=v2AC41dglnM',   // hard rock : AC/DC - Thunderstruck
    6 => 'https://www.youtube.com/watch?v=NUTGr5t3MoY',   // punk : Green Day - Basket Case
];

$spectacles = [];   // [titre, description, video, horaire, style, soiree]
foreach ($soirees as $s => [$date, , , $styleSoiree, , $nb]) {
    for ($k = 0; $k < $nb; $k++) {
        // la soirée de clôture mélange les styles ; sinon le 3e spectacle est d'un style proche
        $style = $s === 11 ? mt_rand(1, 6) : ($k === 2 ? $stylesProches[$styleSoiree] : $styleSoiree);
        $titre = array_shift($groupes[$style]) ?? $faker->unique()->lastName() . ' Band';
        $desc = $description($titre, $style);
        $video = $videos[$style];
        $spectacles[] = [$titre, $desc, $video, "$date {$horaires[$k]}", $style, $s + 1];
    }
}
$sql .= "-- 4. Spectacles (" . count($spectacles) . ")\n";
$sql .= "INSERT INTO spectacle (titre, description, url_video, horaire_previsionnel, style_id, soiree_id) VALUES\n";
$sql .= implode(",\n", array_map(
    fn ($p) => "(" . q($p[0]) . ", " . q($p[1]) . ", " . q($p[2]) . ", " . q($p[3]) . ", {$p[4]}, {$p[5]})",
    $spectacles
)) . ";\n\n";

// 5. ARTISTES et 6. SPECTACLE_ARTISTE : 1 à 3 musiciens par spectacle
$artistes = [];
$liens = [];
foreach ($spectacles as $i => $p) {
    for ($k = 0, $n = mt_rand(1, 3); $k < $n; $k++) {
        $artistes[] = $faker->unique()->name();
        $liens[] = '(' . ($i + 1) . ', ' . count($artistes) . ')';
    }
}
$sql .= "-- 5. Artistes\nINSERT INTO artiste (nom) VALUES\n";
$sql .= implode(",\n", array_map(fn ($a) => "(" . q($a) . ")", $artistes)) . ";\n\n";
$sql .= "-- 6. Spectacle_Artiste\nINSERT INTO spectacle_artiste (spectacle_id, artiste_id) VALUES\n";
$sql .= implode(",\n", $liens) . ";\n\n";

// 7. IMAGES : 1 ou 2 photos par spectacle (picsum.photos, toujours la même pour un spectacle)
$images = [];
foreach ($spectacles as $i => $p) {
    for ($k = 1, $n = mt_rand(1, 2); $k <= $n; $k++) {
        $images[] = "(" . q('https://picsum.photos/seed/nrv-' . ($i + 1) . "-$k/800/600") . ', ' . ($i + 1) . ')';
    }
}
$sql .= "-- 7. Images\nINSERT INTO image (url, spectacle_id) VALUES\n" . implode(",\n", $images) . ";\n\n";

// 8. UTILISATEURS DE TEST (mot de passe : nrv2024)
$hash = password_hash('nrv2024', PASSWORD_BCRYPT);
$utilisateurs = [
    ['Admin NRV', 'admin@nrv.net', 'admin'],
    ['Client Test', 'client@test.com', 'client'],
    ['Marc Dubois', 'marc.dubois@test.com', 'client'],
];
$sql .= "-- 8. Utilisateurs (mot de passe de test : nrv2024)\n";
$sql .= "INSERT INTO utilisateur (nom, email, password_hash, role) VALUES\n";
$sql .= implode(",\n", array_map(fn ($u) => "(" . q($u[0]) . ", " . q($u[1]) . ", " . q($hash) . ", " . q($u[2]) . ")", $utilisateurs)) . ";\n";

// 9. VENTES DÉJÀ RÉALISÉES : les places vendues de chaque soirée correspondent à de vraies commandes
// payées et à de vrais billets, pour que la recette du back-office soit cohérente avec la jauge.
// Les acheteurs sont des clients fictifs qui ne peuvent pas se connecter (mot de passe invalide '!').
$prix = ['normal' => 30.00, 'reduit' => 20.00];   // = back/config/settings.php
$acheteurs = [];
for ($k = 0; $k < 40; $k++) {
    $acheteurs[] = "(" . q($faker->name()) . ", " . q($faker->unique()->safeEmail()) . ", '!', 'client')";
}
$premierAcheteur = count($utilisateurs) + 1;
$sql .= "\n-- 9. Ventes déjà réalisées (acheteurs fictifs, sans mot de passe utilisable)\n";
$sql .= "INSERT INTO utilisateur (nom, email, password_hash, role) VALUES\n" . implode(",\n", $acheteurs) . ";\n\n";
$nbCommandes = 0;
$nbBillets = 0;
foreach ($placesVendues as $soiree => $restant) {
    while ($restant > 0) {
        // grosses commandes (groupes, CE, revendeurs) pour garder un fichier court
        $quantite = min($restant, mt_rand(150, 450));
        $reduits = (int) round($quantite * mt_rand(15, 35) / 100);
        $normaux = $quantite - $reduits;
        $montant = $normaux * $prix['normal'] + $reduits * $prix['reduit'];
        $acheteur = $premierAcheteur + mt_rand(0, count($acheteurs) - 1);
        $date = sprintf('2026-%02d-%02d %02d:%02d:00', mt_rand(9, 10), mt_rand(1, 20), mt_rand(8, 22), mt_rand(0, 59));
        $nbCommandes++;
        $sql .= "INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES ($acheteur, '$date', "
            . number_format($montant, 2, '.', '') . ", 'payee');\n";
        foreach (['normal' => $normaux, 'reduit' => $reduits] as $categorie => $n) {
            if ($n === 0) {
                continue;
            }
            $p = number_format($prix[$categorie], 2, '.', '');
            $sql .= "INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) "
                . "VALUES (currval('commande_id_seq'), $soiree, '$categorie', $n, $p);\n";
            // un billet par place : référence unique, jeton aléatoire de 64 caractères hexadécimaux
            $sql .= "INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) "
                . "SELECT currval('commande_id_seq'), $soiree, 'NRV-V" . sprintf('%04d', $nbCommandes) . "' || substr('$categorie', 1, 1) || lpad(g::text, 4, '0'), "
                . "'$categorie', $p, md5(random()::text) || md5(random()::text) FROM generate_series(1, $n) g;\n";
            $nbBillets += $n;
        }
        $restant -= $quantite;
    }
}

$fichier = __DIR__ . '/data.sql';
if (file_put_contents($fichier, $sql) === false) {
    fwrite(STDERR, "Erreur : impossible d'écrire $fichier\n");
    exit(1);
}
echo 'sql/data.sql généré : ' . count($soirees) . ' soirées, ' . count($spectacles) . ' spectacles, '
    . count($artistes) . ' artistes, ' . count($images) . ' images, ' . count($utilisateurs) . " utilisateurs de test, "
    . "$nbCommandes commandes payées, $nbBillets billets\n";
