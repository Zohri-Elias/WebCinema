DROP TABLE IF EXISTS `webcinema`;
CREATE DATABASE webcinema;
USE webcinema;

DROP TABLE IF EXISTS `film`;
CREATE TABLE `film` (
                        `id_film` int NOT NULL AUTO_INCREMENT,
                        `nom_film` varchar(50) NOT NULL,
                        `duree` varchar(50) NOT NULL,
                        `genre` enum('Comédie', 'Drame', 'Thriller', 'Action', 'Horreur', 'Science-fiction', 'Fantastique', 'Aventure', 'Animation', 'Biographie', 'Documentaire', 'Famille', 'Fantaisie', 'Historique', 'Musical', 'Mystère', 'Romance', 'Sport', 'Guerre', 'Western') NOT NULL,
                        `description` varchar(1000) DEFAULT NULL,
                        `image` varchar(1000) DEFAULT NULL,
                        PRIMARY KEY (`id_film`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
                               `id_reservation` int NOT NULL AUTO_INCREMENT,
                               `ref_user` int NOT NULL,
                               `ref_seance` int NOT NULL,
                               `nbr_place` int NOT NULL,
                               PRIMARY KEY (`id_reservation`),
                               KEY `fk_reservation_user` (`ref_user`),
                               KEY `fk_reservation_seance` (`ref_seance`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `salle`;
CREATE TABLE `salle` (
                         `id_salle` int NOT NULL AUTO_INCREMENT,
                         `nom_salle` varchar(50) NOT NULL,
                         `nb_place` int NOT NULL,
                         PRIMARY KEY (`id_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `seance`;
CREATE TABLE `seance` (
                          `id_seance` int NOT NULL AUTO_INCREMENT,
                          `date` date NOT NULL,
                          `heure` time NOT NULL,
                          `nb_place_res` int NOT NULL,
                          `ref_salle` int DEFAULT NULL,
                          `ref_film` int DEFAULT NULL,
                          PRIMARY KEY (`id_seance`),
                          CONSTRAINT `fk_seance_film` FOREIGN KEY (`ref_film`) REFERENCES `film` (`id_film`) ON DELETE SET NULL ON UPDATE CASCADE,
                          CONSTRAINT `fk_seance_salle` FOREIGN KEY (`ref_salle`) REFERENCES `salle` (`id_salle`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
                               `id_utilisateur` int NOT NULL AUTO_INCREMENT,
                               `nom` varchar(50) NOT NULL,
                               `prenom` varchar(50) NOT NULL,
                               `email` varchar(50) NOT NULL,
                               `mdp` varchar(255) NOT NULL,
                               `role` enum('Client','Admin') NOT NULL,
                               PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `reservation`
    ADD CONSTRAINT `fk_reservation_seance` FOREIGN KEY (`ref_seance`) REFERENCES `seance` (`id_seance`) ON DELETE CASCADE,
    ADD CONSTRAINT `fk_reservation_user` FOREIGN KEY (`ref_user`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;
