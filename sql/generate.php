<?php
require_once __DIR__ . '/vendor/autoload.php';

use Faker\Factory;

$faker = Factory::create('fr_FR');

$sql = "-- Données de test complètes générées pour NRV.net\n";
$sql .= "-- Génération du " . date('Y-m-d H:i:s') . "\n\n";

// 1. LIEUX (3)
$sql .= "-- 1. Lieux\n";
$sql .= "INSERT INTO lieu (nom, adresse, nb_places) VALUES\n";
$sql .= "('Zénith de Nancy', 'Rue du Zénith, 54320 Maxéville', 6000),\n";
$sql .= "('L''Autre Canal', '45 boulevard d''Austrasie, 54000 Nancy', 1200),\n";
$sql .= "('Parc Pépinière', 'Place Boffrand, 54000 Nancy', 3000);\n\n";

// 2. STYLES (6)
$sql .= "-- 2. Styles\n";
$sql .= "INSERT INTO style (libelle) VALUES\n";
$styles = ['Blues rock', 'Classic rock', 'Métal', 'Chanson', 'Hard rock', 'Punk'];
$styleRows = [];
foreach ($styles as $style) {
    $styleRows[] = "('" . addslashes($style) . "')";
}
$sql .= implode(",\n", $styleRows) . ";\n\n";

// 3. SOIREES (12 sur 2 semaines)
$sql .= "-- 3. Soirées\n";
$sql .= "INSERT INTO soiree (nom, thematique, date_debut, lieu_id, places_vendues) VALUES\n";
$soirees = [];
for ($i = 1; $i <= 12; $i++) {
    $nom = "Soirée " . addslashes($faker->word());
    $thematique = "Festival NRV - Nuit " . $i;
    // Dates dans les 2 prochaines semaines
    $date = $faker->dateTimeBetween('now', '+2 weeks')->format('Y-m-d 20:00:00');
    $lieu_id = rand(1, 3);
    $places_vendues = rand(50, 1000);
    $soirees[] = "('$nom', '$thematique', '$date', $lieu_id, $places_vendues)";
}
$sql .= implode(",\n", $soirees) . ";\n\n";

// 4. SPECTACLES (30 répartis sur les 12 soirées)
$sql .= "-- 4. Spectacles\n";
$sql .= "INSERT INTO spectacle (titre, description, url_video, horaire_previsionnel, style_id, soiree_id) VALUES\n";
$spectacles = [];
for ($i = 1; $i <= 30; $i++) {
    $titre = addslashes($faker->catchPhrase());
    $desc = addslashes($faker->paragraph(2));
    $url_video = "https://www.youtube.com/watch?v=dQw4w9WgXcQ";
    $horaire = $faker->time('H:i:00'); // Heure aléatoire
    $style_id = rand(1, 6);
    $soiree_id = rand(1, 12);
    $spectacles[] = "('$titre', '$desc', '$url_video', '$horaire', $style_id, $soiree_id)";
}
$sql .= implode(",\n", $spectacles) . ";\n\n";

// 5. ARTISTES (40 artistes)
$sql .= "-- 5. Artistes\n";
$sql .= "INSERT INTO artiste (nom) VALUES\n";
$artistes = [];
for ($i = 1; $i <= 40; $i++) {
    $artistes[] = "('" . addslashes($faker->name()) . "')";
}
$sql .= implode(",\n", $artistes) . ";\n\n";

// 6. SPECTACLE_ARTISTE (Liaison : 1 à 3 artistes par spectacle)
$sql .= "-- 6. Spectacle_Artiste\n";
$sql .= "INSERT INTO spectacle_artiste (spectacle_id, artiste_id) VALUES\n";
$spectacle_artiste = [];
for ($spectacle_id = 1; $spectacle_id <= 30; $spectacle_id++) {
    $nb_artistes = rand(1, 3);
    $artistes_assignes = (array) array_rand(array_flip(range(1, 40)), $nb_artistes);
    foreach ($artistes_assignes as $artiste_id) {
        $spectacle_artiste[] = "($spectacle_id, $artiste_id)";
    }
}
$sql .= implode(",\n", $spectacle_artiste) . ";\n\n";

// 7. IMAGES (1 à 2 images par spectacle)
$sql .= "-- 7. Images\n";
$sql .= "INSERT INTO image (url, spectacle_id) VALUES\n";
$images = [];
for ($spectacle_id = 1; $spectacle_id <= 30; $spectacle_id++) {
    $nb_images = rand(1, 2);
    for ($j = 0; $j < $nb_images; $j++) {
        $images[] = "('https://picsum.photos/seed/" . rand(1, 1000) . "/800/600', $spectacle_id)";
    }
}
$sql .= implode(",\n", $images) . ";\n\n";

// 8. UTILISATEURS (1 admin, 1 client)
$sql .= "-- 8. Utilisateurs\n";
$sql .= "INSERT INTO utilisateur (nom, email, password_hash, role) VALUES\n";
$hash_password = password_hash('nrv2024', PASSWORD_BCRYPT);
$utilisateurs = [
    "('Admin User', 'admin@nrv.net', '$hash_password', 'admin')",
    "('Client User', 'client@test.com', '$hash_password', 'client')"
];
$sql .= implode(",\n", $utilisateurs) . ";\n";

// Écriture du fichier final
$outputFile = __DIR__ . '/data.sql';
if (file_put_contents($outputFile, $sql) !== false) {
    echo "Succès : le fichier sql/data.sql a été généré avec toutes les données (Soirées, Spectacles, Artistes, Utilisateurs...) !\n";
} else {
    echo "Erreur : impossible d'écrire le fichier sql/data.sql.\n";
}