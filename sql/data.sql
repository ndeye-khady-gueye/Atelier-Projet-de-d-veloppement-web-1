-- Données de test NRV.net, générées par sql/generate.php (FakerPHP, graine 2027)
-- Ne pas modifier à la main : relancer php generate.php

-- 1. Lieux
INSERT INTO lieu (nom, adresse, nb_places) VALUES
('Zénith de Nancy', 'Rue du Zénith, 54320 Maxéville', 6000),
('L''Autre Canal', '45 boulevard d''Austrasie, 54000 Nancy', 1200),
('Parc de la Pépinière', 'Place Boffrand, 54000 Nancy', 3000);

-- 2. Styles
INSERT INTO style (libelle) VALUES
('blues rock'),
('classic rock'),
('métal'),
('chanson'),
('hard rock'),
('punk');

-- 3. Soirées
INSERT INTO soiree (nom, thematique, date_debut, lieu_id, places_vendues) VALUES
('Ouverture : Legends of Rock', 'Les grands classiques du rock', '2027-06-10 20:00:00', 1, 4740),
('Blues Night', 'Blues du delta et de Chicago', '2027-06-11 20:00:00', 2, 924),
('Metal Storm', 'Heavy et thrash métal', '2027-06-12 20:00:00', 1, 4380),
('Chansons Électriques', 'La chanson française version rock', '2027-06-13 20:00:00', 3, 1440),
('Hard Rock Fever', 'Riffs et guitares saturées', '2027-06-15 20:00:00', 2, 396),
('Punk Attitude', 'Punk rock et énergie brute', '2027-06-16 20:00:00', 2, 132),
('Blues & Soul Session', 'Le blues rencontre la soul', '2027-06-17 20:00:00', 3, 2100),
('Classic Rock Revival', 'Le rock des années 70 et 80', '2027-06-18 20:00:00', 3, 1560),
('Nuit du Métal', 'Métal mélodique et symphonique', '2027-06-19 20:00:00', 1, 720),
('Rock en Français', 'Les voix de la scène française', '2027-06-20 20:00:00', 2, 240),
('Heavy Night', 'Hard rock et heavy métal', '2027-06-22 20:00:00', 1, 2400),
('Clôture : Rock Party', 'Grande soirée de clôture tous styles', '2027-06-23 20:00:00', 1, 6000);

-- 4. Spectacles (30)
INSERT INTO spectacle (titre, description, url_video, horaire_previsionnel, style_id, soiree_id) VALUES
('Back to 70s', 'Back to 70s, groupe originaire de Lyon, fait revivre les grands hymnes du rock des années 70. Un set d''une heure qui promet de faire vibrer la salle.', 'https://www.youtube.com/watch?v=fJ9rUzIMcZQ', '2027-06-10 20:00:00', 2, 1),
('Stone Highway', 'Stone Highway, groupe originaire de Genève, enchaîne riffs légendaires et solos interminables. Le groupe présentera les titres de son nouvel album.', 'https://www.youtube.com/watch?v=fJ9rUzIMcZQ', '2027-06-10 21:30:00', 2, 1),
('Thunder Riot', 'Thunder Riot, groupe originaire de Nantes, aligne riffs saturés et refrains à reprendre en chœur. Le groupe présentera les titres de son nouvel album.', 'https://www.youtube.com/watch?v=v2AC41dglnM', '2027-06-10 23:00:00', 5, 1),
('Delta Roots', 'Delta Roots, groupe originaire de Toulouse, revisite le blues du Mississippi avec une slide guitar brûlante. Un concert à ne pas manquer pour ouvrir la soirée.', 'https://www.youtube.com/watch?v=a_426RiwST8', '2027-06-11 20:00:00', 1, 2),
('Chicago Fire', 'Chicago Fire, groupe originaire de Strasbourg, revisite le blues du Mississippi avec une slide guitar brûlante. Le groupe présentera les titres de son nouvel album.', 'https://www.youtube.com/watch?v=a_426RiwST8', '2027-06-11 21:30:00', 1, 2),
('Iron Veins', 'Iron Veins, groupe originaire de Londres, associe double pédale, chœurs épiques et guitares acérées. Un concert à ne pas manquer pour ouvrir la soirée.', 'https://www.youtube.com/watch?v=CD-E-LDc384', '2027-06-12 20:00:00', 3, 3),
('Black Anvil', 'Black Anvil, groupe originaire de Lille, déploie un métal puissant aux riffs martelés. Un concert à ne pas manquer pour ouvrir la soirée.', 'https://www.youtube.com/watch?v=CD-E-LDc384', '2027-06-12 21:30:00', 3, 3),
('High Voltage Kings', 'High Voltage Kings, groupe originaire de Nantes, aligne riffs saturés et refrains à reprendre en chœur. Un concert à ne pas manquer pour ouvrir la soirée.', 'https://www.youtube.com/watch?v=v2AC41dglnM', '2027-06-12 23:00:00', 5, 3),
('Les Mots Bleus', 'Les Mots Bleus, groupe originaire de Toulouse, porte des textes en français sur des guitares électriques. Premier passage du groupe à Nancy.', 'https://www.youtube.com/watch?v=VHoT4N43jK8', '2027-06-13 20:00:00', 4, 4),
('Café Électrique', 'Café Électrique, groupe originaire de Toulouse, mélange chanson à texte et énergie rock. Un set d''une heure qui promet de faire vibrer la salle.', 'https://www.youtube.com/watch?v=VHoT4N43jK8', '2027-06-13 21:30:00', 4, 4),
('Bad Reputation', 'Bad Reputation, groupe originaire de Lyon, aligne riffs saturés et refrains à reprendre en chœur. Le groupe présentera les titres de son nouvel album.', 'https://www.youtube.com/watch?v=v2AC41dglnM', '2027-06-15 20:00:00', 5, 5),
('Wild Engines', 'Wild Engines, groupe originaire de Chicago, envoie un hard rock survolté hérité des grands noms du genre. Un concert à ne pas manquer pour ouvrir la soirée.', 'https://www.youtube.com/watch?v=v2AC41dglnM', '2027-06-15 21:30:00', 5, 5),
('Forge of Souls', 'Forge of Souls, groupe originaire de Nantes, associe double pédale, chœurs épiques et guitares acérées. Premier passage du groupe à Nancy.', 'https://www.youtube.com/watch?v=CD-E-LDc384', '2027-06-15 23:00:00', 3, 5),
('Les Rats Bruyants', 'Les Rats Bruyants, groupe originaire de Genève, réveille l''esprit punk avec des morceaux de deux minutes. Le groupe présentera les titres de son nouvel album.', 'https://www.youtube.com/watch?v=NUTGr5t3MoY', '2027-06-16 20:00:00', 6, 6),
('No Future Club', 'No Future Club, groupe originaire de Bordeaux, joue un punk rapide, court et sans concession. Un set d''une heure qui promet de faire vibrer la salle.', 'https://www.youtube.com/watch?v=NUTGr5t3MoY', '2027-06-16 21:30:00', 6, 6),
('Muddy Road', 'Muddy Road, groupe originaire de Stockholm, mêle harmonica, guitare électrique et voix rocailleuse. Le groupe présentera les titres de son nouvel album.', 'https://www.youtube.com/watch?v=a_426RiwST8', '2027-06-17 20:00:00', 1, 7),
('Blue Lantern', 'Blue Lantern, groupe originaire de Bordeaux, mêle harmonica, guitare électrique et voix rocailleuse. Un set d''une heure qui promet de faire vibrer la salle.', 'https://www.youtube.com/watch?v=a_426RiwST8', '2027-06-17 21:30:00', 1, 7),
('The Velvet Riders', 'The Velvet Riders, groupe originaire de Lille, enchaîne riffs légendaires et solos interminables. Un concert à ne pas manquer pour ouvrir la soirée.', 'https://www.youtube.com/watch?v=fJ9rUzIMcZQ', '2027-06-17 23:00:00', 2, 7),
('Golden Vinyl', 'Golden Vinyl, groupe originaire de Rennes, enchaîne riffs légendaires et solos interminables. Premier passage du groupe à Nancy.', 'https://www.youtube.com/watch?v=fJ9rUzIMcZQ', '2027-06-18 20:00:00', 2, 8),
('Rolling Thunder Revue', 'Rolling Thunder Revue, groupe originaire de Chicago, enchaîne riffs légendaires et solos interminables. Le groupe présentera les titres de son nouvel album.', 'https://www.youtube.com/watch?v=fJ9rUzIMcZQ', '2027-06-18 21:30:00', 2, 8),
('Nordic Hammer', 'Nordic Hammer, groupe originaire de Strasbourg, associe double pédale, chœurs épiques et guitares acérées. Un concert à ne pas manquer pour ouvrir la soirée.', 'https://www.youtube.com/watch?v=CD-E-LDc384', '2027-06-19 20:00:00', 3, 9),
('Crimson Abyss', 'Crimson Abyss, groupe originaire de Bruxelles, associe double pédale, chœurs épiques et guitares acérées. Une prestation scénique réputée pour son énergie.', 'https://www.youtube.com/watch?v=CD-E-LDc384', '2027-06-19 21:30:00', 3, 9),
('Red Lightning', 'Red Lightning, groupe originaire de Genève, envoie un hard rock survolté hérité des grands noms du genre. Un set d''une heure qui promet de faire vibrer la salle.', 'https://www.youtube.com/watch?v=v2AC41dglnM', '2027-06-19 23:00:00', 5, 9),
('Les Enfants du Rock', 'Les Enfants du Rock, groupe originaire de Bruxelles, porte des textes en français sur des guitares électriques. Le groupe présentera les titres de son nouvel album.', 'https://www.youtube.com/watch?v=VHoT4N43jK8', '2027-06-20 20:00:00', 4, 10),
('Madame Fuzz', 'Madame Fuzz, groupe originaire de Berlin, mélange chanson à texte et énergie rock. Une prestation scénique réputée pour son énergie.', 'https://www.youtube.com/watch?v=VHoT4N43jK8', '2027-06-20 21:30:00', 4, 10),
('Rock Bottom Riders', 'Rock Bottom Riders, groupe originaire de Memphis, aligne riffs saturés et refrains à reprendre en chœur. Un set d''une heure qui promet de faire vibrer la salle.', 'https://www.youtube.com/watch?v=v2AC41dglnM', '2027-06-22 20:00:00', 5, 11),
('Loud Machine', 'Loud Machine, groupe originaire de Toulouse, aligne riffs saturés et refrains à reprendre en chœur. Premier passage du groupe à Nancy.', 'https://www.youtube.com/watch?v=v2AC41dglnM', '2027-06-22 21:30:00', 5, 11),
('Steel Prophecy', 'Steel Prophecy, groupe originaire de Toulouse, associe double pédale, chœurs épiques et guitares acérées. Le groupe présentera les titres de son nouvel album.', 'https://www.youtube.com/watch?v=CD-E-LDc384', '2027-06-22 23:00:00', 3, 11),
('Dark Meridian', 'Dark Meridian, groupe originaire de Toulouse, déploie un métal puissant aux riffs martelés. Un set d''une heure qui promet de faire vibrer la salle.', 'https://www.youtube.com/watch?v=CD-E-LDc384', '2027-06-23 20:00:00', 3, 12),
('La Ligne Claire', 'La Ligne Claire, groupe originaire de Londres, mélange chanson à texte et énergie rock. Le groupe présentera les titres de son nouvel album.', 'https://www.youtube.com/watch?v=VHoT4N43jK8', '2027-06-23 21:30:00', 4, 12);

-- 5. Artistes
INSERT INTO artiste (nom) VALUES
('Dominique Bouvier'),
('Denis Leroy'),
('Marie du Clerc'),
('Laurent Joubert-Poulain'),
('Théophile Chauvet-Legrand'),
('Zacharie Mallet'),
('Gabriel Gaillard-Noel'),
('Maggie Navarro'),
('Georges Chretien'),
('Bertrand-Gérard Marchand'),
('Marianne-Pauline Pineau'),
('Amélie Lebon'),
('Marthe Alexandre'),
('Jules Aubry'),
('Valérie-Luce Pascal'),
('Stéphane Mendes'),
('Frédéric Olivier-Didier'),
('Martine-Dominique Aubert'),
('Sébastien Colas-Goncalves'),
('Agathe Gaudin-Meunier'),
('Laurent Pelletier'),
('Margaret Carlier'),
('Édouard Faure'),
('Édouard-Frédéric Guibert'),
('Lorraine Delahaye'),
('Christine Deschamps'),
('Thomas Diallo'),
('Gérard Bousquet'),
('Éléonore de Rey'),
('Virginie Lemoine'),
('Alfred Perrier'),
('Maurice Lemaire'),
('Nath Loiseau'),
('Capucine Philippe'),
('Louis Salmon'),
('Charles du Gomez'),
('Laure Morel'),
('Michel Lebrun'),
('Thérèse Hoarau'),
('Théodore Blanchard'),
('Philippine Gillet-Remy'),
('Hélène Couturier'),
('Emmanuel Normand'),
('Maurice Picard'),
('Élodie Leclercq'),
('Anaïs Leroux'),
('Marine Lefort'),
('Émile-Timothée Tessier'),
('Inès-Michelle Lacroix'),
('Margot Berthelot'),
('Henri Dupre'),
('Adrien Teixeira'),
('Emmanuelle Brunet'),
('Martin Le Gimenez'),
('Roland Raynaud'),
('Anastasie Bernier'),
('Michel Boulanger'),
('Brigitte-Noémi Mendes'),
('Hortense-Sylvie Breton'),
('Antoinette Hamel'),
('Christine Collin'),
('Margot Georges');

-- 6. Spectacle_Artiste
INSERT INTO spectacle_artiste (spectacle_id, artiste_id) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 8),
(4, 9),
(5, 10),
(6, 11),
(7, 12),
(7, 13),
(8, 14),
(8, 15),
(9, 16),
(9, 17),
(9, 18),
(10, 19),
(10, 20),
(11, 21),
(12, 22),
(12, 23),
(12, 24),
(13, 25),
(13, 26),
(13, 27),
(14, 28),
(14, 29),
(14, 30),
(15, 31),
(16, 32),
(16, 33),
(17, 34),
(17, 35),
(18, 36),
(19, 37),
(19, 38),
(19, 39),
(20, 40),
(20, 41),
(21, 42),
(21, 43),
(21, 44),
(22, 45),
(22, 46),
(23, 47),
(23, 48),
(23, 49),
(24, 50),
(24, 51),
(25, 52),
(26, 53),
(26, 54),
(27, 55),
(27, 56),
(28, 57),
(28, 58),
(28, 59),
(29, 60),
(30, 61),
(30, 62);

-- 7. Images
INSERT INTO image (url, spectacle_id) VALUES
('https://picsum.photos/seed/nrv-1-1/800/600', 1),
('https://picsum.photos/seed/nrv-2-1/800/600', 2),
('https://picsum.photos/seed/nrv-2-2/800/600', 2),
('https://picsum.photos/seed/nrv-3-1/800/600', 3),
('https://picsum.photos/seed/nrv-3-2/800/600', 3),
('https://picsum.photos/seed/nrv-4-1/800/600', 4),
('https://picsum.photos/seed/nrv-4-2/800/600', 4),
('https://picsum.photos/seed/nrv-5-1/800/600', 5),
('https://picsum.photos/seed/nrv-5-2/800/600', 5),
('https://picsum.photos/seed/nrv-6-1/800/600', 6),
('https://picsum.photos/seed/nrv-7-1/800/600', 7),
('https://picsum.photos/seed/nrv-7-2/800/600', 7),
('https://picsum.photos/seed/nrv-8-1/800/600', 8),
('https://picsum.photos/seed/nrv-9-1/800/600', 9),
('https://picsum.photos/seed/nrv-10-1/800/600', 10),
('https://picsum.photos/seed/nrv-10-2/800/600', 10),
('https://picsum.photos/seed/nrv-11-1/800/600', 11),
('https://picsum.photos/seed/nrv-11-2/800/600', 11),
('https://picsum.photos/seed/nrv-12-1/800/600', 12),
('https://picsum.photos/seed/nrv-13-1/800/600', 13),
('https://picsum.photos/seed/nrv-13-2/800/600', 13),
('https://picsum.photos/seed/nrv-14-1/800/600', 14),
('https://picsum.photos/seed/nrv-15-1/800/600', 15),
('https://picsum.photos/seed/nrv-16-1/800/600', 16),
('https://picsum.photos/seed/nrv-17-1/800/600', 17),
('https://picsum.photos/seed/nrv-17-2/800/600', 17),
('https://picsum.photos/seed/nrv-18-1/800/600', 18),
('https://picsum.photos/seed/nrv-19-1/800/600', 19),
('https://picsum.photos/seed/nrv-20-1/800/600', 20),
('https://picsum.photos/seed/nrv-21-1/800/600', 21),
('https://picsum.photos/seed/nrv-21-2/800/600', 21),
('https://picsum.photos/seed/nrv-22-1/800/600', 22),
('https://picsum.photos/seed/nrv-23-1/800/600', 23),
('https://picsum.photos/seed/nrv-23-2/800/600', 23),
('https://picsum.photos/seed/nrv-24-1/800/600', 24),
('https://picsum.photos/seed/nrv-24-2/800/600', 24),
('https://picsum.photos/seed/nrv-25-1/800/600', 25),
('https://picsum.photos/seed/nrv-26-1/800/600', 26),
('https://picsum.photos/seed/nrv-27-1/800/600', 27),
('https://picsum.photos/seed/nrv-27-2/800/600', 27),
('https://picsum.photos/seed/nrv-28-1/800/600', 28),
('https://picsum.photos/seed/nrv-29-1/800/600', 29),
('https://picsum.photos/seed/nrv-29-2/800/600', 29),
('https://picsum.photos/seed/nrv-30-1/800/600', 30);

-- 8. Utilisateurs (mot de passe de test : nrv2024)
INSERT INTO utilisateur (nom, email, password_hash, role) VALUES
('Admin NRV', 'admin@nrv.net', '$2y$10$SQDhESrIbXOJLWi.x2dRG.plIjm5/evKwxhdvRXuaMjl9W1iiC3py', 'admin'),
('Client Test', 'client@test.com', '$2y$10$SQDhESrIbXOJLWi.x2dRG.plIjm5/evKwxhdvRXuaMjl9W1iiC3py', 'client'),
('Marc Dubois', 'marc.dubois@test.com', '$2y$10$SQDhESrIbXOJLWi.x2dRG.plIjm5/evKwxhdvRXuaMjl9W1iiC3py', 'client');

-- 9. Ventes déjà réalisées (acheteurs fictifs, sans mot de passe utilisable)
INSERT INTO utilisateur (nom, email, password_hash, role) VALUES
('Alain Guyon', 'aime50@example.com', '!', 'client'),
('Paulette Peron', 'begue.hortense@example.com', '!', 'client'),
('Josette Denis', 'timothee37@example.org', '!', 'client'),
('Alexandre Leduc', 'maurice30@example.org', '!', 'client'),
('Léon Couturier', 'clemence20@example.com', '!', 'client'),
('Céline Lopes', 'rbegue@example.org', '!', 'client'),
('Hugues Gilles', 'monique58@example.com', '!', 'client'),
('Adélaïde Hardy', 'alphonse.moulin@example.net', '!', 'client'),
('Laurent Hubert', 'paul28@example.org', '!', 'client'),
('Roger Michaud', 'fabre.helene@example.com', '!', 'client'),
('Aimé Leblanc', 'ynormand@example.org', '!', 'client'),
('Anne Leroy', 'lroger@example.net', '!', 'client'),
('Margaud Antoine', 'netienne@example.com', '!', 'client'),
('Raymond Payet', 'corinne.gay@example.org', '!', 'client'),
('Thomas Dupuy', 'sabine19@example.net', '!', 'client'),
('Inès du Bodin', 'dominique67@example.com', '!', 'client'),
('Christelle du Devaux', 'chevallier.claude@example.org', '!', 'client'),
('Édouard Lelievre', 'glejeune@example.org', '!', 'client'),
('Dominique Laroche', 'rjoly@example.org', '!', 'client'),
('Paul Pichon', 'wpoulain@example.org', '!', 'client'),
('Virginie Dumas-Guillet', 'stephane31@example.net', '!', 'client'),
('Honoré Aubert-Perret', 'fournier.jacqueline@example.com', '!', 'client'),
('Nathalie Coulon', 'marianne.peltier@example.net', '!', 'client'),
('Roland Leveque', 'louis.louis@example.com', '!', 'client'),
('Benoît Robert', 'henriette90@example.net', '!', 'client'),
('Dominique Guillet', 'louis.emmanuel@example.org', '!', 'client'),
('Patrick Da Silva-Weiss', 'blucas@example.com', '!', 'client'),
('Juliette Auger', 'fdaniel@example.net', '!', 'client'),
('Alain Royer', 'margot.peron@example.org', '!', 'client'),
('Stéphanie Boulanger', 'goncalves.marianne@example.org', '!', 'client'),
('Martine-Denise Gillet', 'renee89@example.org', '!', 'client'),
('Marcelle Gregoire', 'lesage.corinne@example.org', '!', 'client'),
('Vincent Sanchez', 'xparis@example.net', '!', 'client'),
('Philippe de Salmon', 'alfred08@example.net', '!', 'client'),
('Martine Raymond', 'martine93@example.org', '!', 'client'),
('Auguste du Lesage', 'pineau.manon@example.org', '!', 'client'),
('Véronique Chauveau', 'leroux.cecile@example.net', '!', 'client'),
('Luce Ribeiro', 'vbertrand@example.org', '!', 'client'),
('Margaud Tanguy-Barbier', 'bernadette43@example.net', '!', 'client'),
('Maggie Mercier', 'ualves@example.net', '!', 'client');

INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (7, '2026-09-08 17:30:00', 12240.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 350, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0001' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 350) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 87, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0001' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 87) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (27, '2026-10-15 22:40:00', 9490.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 269, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0002' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 269) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 71, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0002' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 71) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (21, '2026-10-08 15:46:00', 7100.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 208, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0003' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 208) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 43, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0003' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 43) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (18, '2026-09-09 18:35:00', 5980.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 150, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0004' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 150) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 74, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0004' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 74) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (22, '2026-09-14 21:01:00', 4840.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 132, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0005' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 132) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 44, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0005' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 44) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (30, '2026-10-07 14:26:00', 9260.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 274, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0006' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 274) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 52, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0006' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 52) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (25, '2026-09-19 15:01:00', 6610.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 173, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0007' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 173) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 71, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0007' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 71) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (22, '2026-09-12 19:36:00', 7640.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 218, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0008' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 218) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 55, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0008' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 55) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (39, '2026-10-16 17:07:00', 11440.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 284, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0009' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 284) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 146, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0009' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 146) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (23, '2026-10-01 08:58:00', 11070.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 275, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0010' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 275) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 141, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0010' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 141) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (26, '2026-09-10 22:41:00', 6540.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 166, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0011' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 166) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 78, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0011' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 78) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (18, '2026-09-17 11:03:00', 9100.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 246, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0012' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 246) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 86, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0012' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 86) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (5, '2026-09-14 12:40:00', 8620.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 242, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0013' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 242) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 68, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0013' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 68) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (27, '2026-10-02 15:46:00', 7520.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 224, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0014' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 224) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 40, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0014' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 40) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (33, '2026-09-19 15:26:00', 6500.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 172, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0015' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 172) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 67, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0015' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 67) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (13, '2026-09-03 12:40:00', 6360.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'normal', 168, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0016' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 168) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 1, 'reduit', 66, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 1, 'NRV-V0016' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 66) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (25, '2026-10-17 21:49:00', 9900.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 2, 'normal', 278, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 2, 'NRV-V0017' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 278) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 2, 'reduit', 78, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 2, 'NRV-V0017' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 78) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (10, '2026-10-20 17:51:00', 7180.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 2, 'normal', 184, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 2, 'NRV-V0018' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 184) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 2, 'reduit', 83, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 2, 'NRV-V0018' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 83) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (26, '2026-09-14 09:07:00', 6380.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 2, 'normal', 182, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 2, 'NRV-V0019' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 182) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 2, 'reduit', 46, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 2, 'NRV-V0019' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 46) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (31, '2026-09-07 13:59:00', 1950.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 2, 'normal', 49, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 2, 'NRV-V0020' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 49) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 2, 'reduit', 24, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 2, 'NRV-V0020' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 24) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (27, '2026-09-10 11:35:00', 6550.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 177, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0021' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 177) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 62, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0021' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 62) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (41, '2026-10-09 18:02:00', 10650.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 279, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0022' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 279) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 114, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0022' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 114) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (35, '2026-10-16 18:05:00', 8720.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 238, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0023' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 238) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 79, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0023' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 79) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (13, '2026-09-04 10:29:00', 5980.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 168, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0024' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 168) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 47, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0024' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 47) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (31, '2026-10-07 08:19:00', 6350.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 183, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0025' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 183) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 43, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0025' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 43) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (19, '2026-10-10 18:13:00', 5960.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 158, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0026' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 158) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 61, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0026' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 61) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (29, '2026-09-12 11:06:00', 10280.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 272, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0027' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 272) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 106, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0027' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 106) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (34, '2026-09-19 10:28:00', 10600.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 300, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0028' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 300) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 80, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0028' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 80) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (16, '2026-10-17 14:17:00', 5960.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 178, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0029' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 178) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 31, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0029' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 31) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (32, '2026-10-19 10:38:00', 11070.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 275, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0030' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 275) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 141, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0030' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 141) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (10, '2026-10-10 10:51:00', 4450.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 119, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0031' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 119) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 44, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0031' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 44) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (23, '2026-09-14 18:24:00', 9800.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 292, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0032' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 292) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 52, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0032' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 52) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (28, '2026-10-01 22:25:00', 5470.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 143, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0033' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 143) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 59, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0033' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 59) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (27, '2026-09-04 12:00:00', 10570.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 271, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0034' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 271) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 122, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0034' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 122) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (8, '2026-10-06 11:35:00', 7480.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 202, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0035' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 202) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 71, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0035' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 71) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (16, '2026-09-02 10:52:00', 360.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'normal', 10, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0036' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 10) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 3, 'reduit', 3, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 3, 'NRV-V0036' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 3) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (27, '2026-09-09 22:46:00', 5520.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 4, 'normal', 156, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 4, 'NRV-V0037' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 156) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 4, 'reduit', 42, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 4, 'NRV-V0037' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 42) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (25, '2026-10-14 13:58:00', 9340.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 4, 'normal', 232, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 4, 'NRV-V0038' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 232) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 4, 'reduit', 119, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 4, 'NRV-V0038' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 119) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (34, '2026-09-14 20:22:00', 9720.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 4, 'normal', 244, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 4, 'NRV-V0039' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 244) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 4, 'reduit', 120, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 4, 'NRV-V0039' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 120) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (33, '2026-10-19 17:27:00', 5680.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 4, 'normal', 144, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 4, 'NRV-V0040' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 144) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 4, 'reduit', 68, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 4, 'NRV-V0040' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 68) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (21, '2026-09-09 20:10:00', 8910.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 4, 'normal', 261, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 4, 'NRV-V0041' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 261) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 4, 'reduit', 54, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 4, 'NRV-V0041' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 54) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (38, '2026-09-20 08:50:00', 9060.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 5, 'normal', 252, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 5, 'NRV-V0042' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 252) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 5, 'reduit', 75, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 5, 'NRV-V0042' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 75) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (27, '2026-10-02 08:00:00', 1880.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 5, 'normal', 50, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 5, 'NRV-V0043' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 50) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 5, 'reduit', 19, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 5, 'NRV-V0043' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 19) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (25, '2026-10-08 16:50:00', 3620.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 6, 'normal', 98, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 6, 'NRV-V0044' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 98) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 6, 'reduit', 34, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 6, 'NRV-V0044' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 34) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (25, '2026-10-13 11:00:00', 4270.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 7, 'normal', 113, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 7, 'NRV-V0045' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 113) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 7, 'reduit', 44, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 7, 'NRV-V0045' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 44) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (23, '2026-09-11 22:55:00', 11340.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 7, 'normal', 312, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 7, 'NRV-V0046' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 312) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 7, 'reduit', 99, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 7, 'NRV-V0046' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 99) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (22, '2026-09-03 14:15:00', 9570.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 7, 'normal', 251, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 7, 'NRV-V0047' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 251) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 7, 'reduit', 102, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 7, 'NRV-V0047' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 102) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (43, '2026-10-15 09:49:00', 11170.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 7, 'normal', 319, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 7, 'NRV-V0048' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 319) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 7, 'reduit', 80, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 7, 'NRV-V0048' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 80) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (13, '2026-10-16 15:01:00', 8560.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 7, 'normal', 236, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 7, 'NRV-V0049' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 236) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 7, 'reduit', 74, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 7, 'NRV-V0049' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 74) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (38, '2026-10-06 18:26:00', 8430.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 7, 'normal', 239, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 7, 'NRV-V0050' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 239) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 7, 'reduit', 63, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 7, 'NRV-V0050' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 63) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (8, '2026-10-20 14:26:00', 4640.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 7, 'normal', 128, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 7, 'NRV-V0051' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 128) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 7, 'reduit', 40, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 7, 'NRV-V0051' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 40) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (33, '2026-10-16 12:04:00', 12740.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 8, 'normal', 380, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 8, 'NRV-V0052' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 380) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 8, 'reduit', 67, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 8, 'NRV-V0052' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 67) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (27, '2026-10-12 13:52:00', 5080.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 8, 'normal', 130, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 8, 'NRV-V0053' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 130) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 8, 'reduit', 59, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 8, 'NRV-V0053' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 59) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (28, '2026-09-06 20:28:00', 4540.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 8, 'normal', 124, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 8, 'NRV-V0054' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 124) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 8, 'reduit', 41, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 8, 'NRV-V0054' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 41) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (32, '2026-09-04 14:42:00', 8800.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 8, 'normal', 238, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 8, 'NRV-V0055' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 238) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 8, 'reduit', 83, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 8, 'NRV-V0055' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 83) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (4, '2026-09-20 08:53:00', 5480.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 8, 'normal', 148, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 8, 'NRV-V0056' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 148) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 8, 'reduit', 52, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 8, 'NRV-V0056' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 52) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (18, '2026-09-16 18:35:00', 5140.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 8, 'normal', 132, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 8, 'NRV-V0057' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 132) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 8, 'reduit', 59, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 8, 'NRV-V0057' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 59) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (15, '2026-10-01 13:06:00', 1280.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 8, 'normal', 34, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 8, 'NRV-V0058' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 34) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 8, 'reduit', 13, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 8, 'NRV-V0058' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 13) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (41, '2026-10-08 12:13:00', 4590.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 9, 'normal', 119, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 9, 'NRV-V0059' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 119) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 9, 'reduit', 51, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 9, 'NRV-V0059' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 51) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (22, '2026-10-20 17:52:00', 6500.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 9, 'normal', 184, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 9, 'NRV-V0060' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 184) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 9, 'reduit', 49, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 9, 'NRV-V0060' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 49) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (13, '2026-10-03 11:50:00', 8910.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 9, 'normal', 257, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 9, 'NRV-V0061' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 257) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 9, 'reduit', 60, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 9, 'NRV-V0061' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 60) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (5, '2026-10-15 18:08:00', 6550.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 10, 'normal', 175, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 10, 'NRV-V0062' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 175) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 10, 'reduit', 65, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 10, 'NRV-V0062' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 65) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (31, '2026-10-04 08:01:00', 11680.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'normal', 296, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0063' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 296) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'reduit', 140, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0063' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 140) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (25, '2026-09-05 08:40:00', 11930.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'normal', 325, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0064' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 325) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'reduit', 109, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0064' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 109) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (29, '2026-10-20 08:46:00', 4780.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'normal', 134, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0065' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 134) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'reduit', 38, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0065' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 38) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (15, '2026-10-13 10:46:00', 4890.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'normal', 141, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0066' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 141) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'reduit', 33, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0066' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 33) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (4, '2026-09-05 14:20:00', 10540.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'normal', 282, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0067' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 282) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'reduit', 104, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0067' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 104) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (19, '2026-10-16 09:07:00', 7510.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'normal', 197, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0068' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 197) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'reduit', 80, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0068' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 80) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (35, '2026-09-03 10:04:00', 5260.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'normal', 138, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0069' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 138) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'reduit', 56, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0069' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 56) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (26, '2026-09-07 15:14:00', 5040.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'normal', 148, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0070' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 148) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'reduit', 30, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0070' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 30) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (24, '2026-10-02 14:30:00', 4020.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'normal', 104, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0071' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 104) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 11, 'reduit', 45, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 11, 'NRV-V0071' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 45) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (34, '2026-10-03 18:59:00', 10910.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 283, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0072' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 283) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 121, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0072' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 121) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (8, '2026-09-05 09:11:00', 4390.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 131, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0073' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 131) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 23, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0073' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 23) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (20, '2026-09-16 17:13:00', 10660.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 282, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0074' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 282) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 110, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0074' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 110) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (8, '2026-10-14 20:56:00', 11560.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 290, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0075' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 290) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 143, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0075' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 143) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (10, '2026-10-10 20:38:00', 9120.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 246, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0076' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 246) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 87, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0076' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 87) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (43, '2026-10-19 13:40:00', 10390.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 275, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0077' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 275) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 107, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0077' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 107) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (12, '2026-09-17 09:50:00', 11980.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 342, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0078' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 342) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 86, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0078' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 86) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (12, '2026-10-16 16:09:00', 6640.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 172, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0079' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 172) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 74, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0079' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 74) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (8, '2026-09-08 22:05:00', 7780.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 202, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0080' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 202) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 86, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0080' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 86) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (25, '2026-09-19 19:26:00', 5730.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 171, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0081' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 171) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 30, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0081' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 30) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (37, '2026-10-17 17:08:00', 6230.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 181, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0082' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 181) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 40, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0082' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 40) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (18, '2026-09-10 17:35:00', 5210.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 131, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0083' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 131) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 64, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0083' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 64) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (27, '2026-09-06 10:23:00', 4810.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 135, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0084' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 135) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 38, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0084' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 38) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (30, '2026-09-04 10:38:00', 9460.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 282, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0085' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 282) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 50, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0085' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 50) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (35, '2026-09-14 08:59:00', 4230.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 115, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0086' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 115) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 39, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0086' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 39) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (30, '2026-10-18 09:07:00', 7730.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 219, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0087' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 219) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 58, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0087' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 58) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (28, '2026-09-05 12:17:00', 6890.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 169, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0088' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 169) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 91, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0088' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 91) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (24, '2026-09-08 21:48:00', 5040.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 136, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0089' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 136) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 48, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0089' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 48) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (12, '2026-09-05 14:10:00', 9270.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 255, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0090' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 255) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 81, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0090' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 81) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (40, '2026-10-09 10:45:00', 11470.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 325, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0091' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 325) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 86, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0091' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 86) g;
INSERT INTO commande (utilisateur_id, date_commande, montant_total, statut) VALUES (6, '2026-10-19 15:34:00', 5210.00, 'payee');
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'normal', 129, 30.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0092' || substr('normal', 1, 1) || lpad(g::text, 4, '0'), 'normal', 30.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 129) g;
INSERT INTO ligne_commande (commande_id, soiree_id, categorie, quantite, prix_unitaire) VALUES (currval('commande_id_seq'), 12, 'reduit', 67, 20.00);
INSERT INTO billet (commande_id, soiree_id, reference, categorie, prix, token) SELECT currval('commande_id_seq'), 12, 'NRV-V0092' || substr('reduit', 1, 1) || lpad(g::text, 4, '0'), 'reduit', 20.00, md5(random()::text) || md5(random()::text) FROM generate_series(1, 67) g;
