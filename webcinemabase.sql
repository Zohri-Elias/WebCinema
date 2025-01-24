CREATE DATABASE IF NOT EXISTS webcinema;
USE webcinema;

DROP TABLE IF EXISTS `film`;
CREATE TABLE IF NOT EXISTS `film` (
                                      `id_film` int NOT NULL AUTO_INCREMENT,
                                      `nom_film` varchar(50) NOT NULL,
    `duree` varchar(50) NOT NULL,
    `genre` enum('Comédie', 'Drame', 'Thriller', 'Action', 'Horreur', 'Science-fiction', 'Fantastique', 'Aventure', 'Animation', 'Biographie', 'Documentaire', 'Famille', 'Fantaisie', 'Historique', 'Musical', 'Mystère', 'Romance', 'Sport', 'Guerre', 'Western') NOT NULL,
    `description` varchar(400) DEFAULT NULL,
    `image` blob,
    PRIMARY KEY (`id_film`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
                                             `id_reservation` int NOT NULL AUTO_INCREMENT,
                                             `ref_user` int NOT NULL,
                                             `ref_seance` int NOT NULL,
                                             `nbr_place` int NOT NULL,
                                             PRIMARY KEY (`id_reservation`),
    KEY `fk_reservation_user` (`ref_user`),
    KEY `fk_reservation_seance` (`ref_seance`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
                                       `id_salle` int NOT NULL AUTO_INCREMENT,
                                       `nom_salle` varchar(50) NOT NULL,
    `nb_place` int NOT NULL,
    PRIMARY KEY (`id_salle`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `sceance`;
CREATE TABLE IF NOT EXISTS `sceance` (
                                         `id_sceance` int NOT NULL AUTO_INCREMENT,
                                         `date` date NOT NULL,
                                         `heure` time NOT NULL,
                                         `email` varchar(50) NOT NULL,
    `nb_place_res` int NOT NULL,
    `ref_salle` int DEFAULT NULL,
    `ref_film` int DEFAULT NULL,
    PRIMARY KEY (`id_sceance`),
    KEY `fk_seance_film` (`ref_film`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
                                             `id_utilisateur` int NOT NULL AUTO_INCREMENT,
                                             `nom` varchar(50) NOT NULL,
    `prenom` varchar(50) NOT NULL,
    `email` varchar(50) NOT NULL,
    `mdp` varchar(255) NOT NULL,
    `role` enum('Client','Admin') NOT NULL,
    PRIMARY KEY (`id_utilisateur`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `reservation`
    ADD CONSTRAINT `fk_reservation_seance` FOREIGN KEY (`ref_seance`) REFERENCES `sceance` (`id_sceance`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reservation_user` FOREIGN KEY (`ref_user`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;

ALTER TABLE `sceance`
    ADD CONSTRAINT `fk_seance_film` FOREIGN KEY (`ref_film`) REFERENCES `film` (`id_film`) ON DELETE CASCADE;


ALTER TABLE film ADD COLUMN date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
