-- Petit jeu de données pour le développement (C le remplacera par data.sql généré avec Faker).

INSERT INTO lieu (nom, adresse, nb_places) VALUES
    ('Zénith de Nancy', 'Rue du Zénith, 54320 Maxéville', 500),
    ('L''Autre Canal', '45 boulevard d''Austrasie, 54000 Nancy', 200);

INSERT INTO style (libelle) VALUES ('blues rock'), ('classic rock'), ('métal'), ('chanson');

INSERT INTO soiree (nom, thematique, date_debut, lieu_id, places_vendues) VALUES
    ('Blues Night', 'soirée blues', '2027-06-12 20:00', 2, 120),
    ('Metal Storm', 'soirée métal', '2027-06-13 19:30', 1, 500),
    ('Rock Legends', 'soirée classic rock', '2027-06-15 20:00', 1, 50);

INSERT INTO spectacle (titre, description, url_video, horaire_previsionnel, style_id, soiree_id) VALUES
    ('Delta Roots', 'Blues du Mississippi revisité.', 'https://www.youtube.com/watch?v=exemple1', '2027-06-12 20:30', 1, 1),
    ('Chicago Fire', 'Blues électrique de Chicago.', NULL, '2027-06-12 22:00', 1, 1),
    ('Iron Veins', 'Heavy metal sans compromis.', 'https://www.youtube.com/watch?v=exemple2', '2027-06-13 20:00', 3, 2),
    ('Les Mots Bleus', 'Chanson française rock.', NULL, '2027-06-13 21:30', 4, 2),
    ('Back to 70s', 'Les grands classiques du rock.', NULL, '2027-06-15 20:30', 2, 3);

INSERT INTO artiste (nom) VALUES ('Sam Waters'), ('Lily Moon'), ('The Irons'), ('Claire Dubois'), ('Max Stone');

INSERT INTO spectacle_artiste (spectacle_id, artiste_id) VALUES (1, 1), (1, 2), (2, 2), (3, 3), (4, 4), (5, 5);

INSERT INTO image (url, spectacle_id) VALUES
    ('img/spectacles/1.jpg', 1), ('img/spectacles/1b.jpg', 1), ('img/spectacles/2.jpg', 2),
    ('img/spectacles/3.jpg', 3), ('img/spectacles/4.jpg', 4), ('img/spectacles/5.jpg', 5);
