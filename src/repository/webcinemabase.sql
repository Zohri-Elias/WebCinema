CREATE DATABASE IF NOT EXISTS webcinema;
USE webcinema;

DROP TABLE IF EXISTS `film`;
CREATE TABLE IF NOT EXISTS `film` (
                                      `id_film` int NOT NULL AUTO_INCREMENT,
                                      `nom_film` varchar(50) NOT NULL,
    `duree` varchar(50) NOT NULL,
    `genre` enum('Comédie', 'Drame', 'Thriller', 'Action', 'Horreur', 'Science-fiction', 'Fantastique', 'Aventure', 'Animation', 'Biographie', 'Documentaire', 'Famille', 'Fantaisie', 'Historique', 'Musical', 'Mystère', 'Romance', 'Sport', 'Guerre', 'Western') NOT NULL,
    `description` varchar(1000) DEFAULT NULL,
    `image` varchar(1000 DEFAULT NULL,
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


INSERT INTO film VALUES (1,"L'Amour au présent",'1h48',"Drame","Almut et Tobias voient leur vie à jamais bouleversée lorsqu'une rencontre accidentelle les réunit. Une romance profondément émouvante sur les instants qui nous changent, et ceux qui nous construisent.","https://fr.web.img4.acsta.net/c_310_420/img/c6/7d/c67d718699bb1158eace4179794b6861.jpg",null)

INSERT INTO film VALUES (2,"Mufasa : Le Roi Lion",'1h 58min',"Aventure",'Rafiki raconte à la jeune lionne Kiara - la fille de Simba et Nala – la légende de Mufasa. Il est aidé en cela par Timon et Pumbaa, dont les formules choc sont désormais bien connues. Relatée sous forme de flashbacks, l''histoire de Mufasa est celle d’un lionceau orphelin, seul et désemparé qui, un jour, fait la connaissance du sympathique Taka, héritier d''une lignée royale. Cette rencontre fortuite marque le point de départ d’un périple riche en péripéties d’un petit groupe « d’indésirables » qui s’est formé autour d’eux et qui est désormais à la recherche de son destin. Leurs liens d’amitié seront soumis à rude épreuve lorsqu’il leur faudra faire équipe pour échapper à un ennemi aussi menaçant que mortel…
',"https://fr.web.img6.acsta.net/c_310_420/img/f5/f2/f5f2447c4246e42eb3e69040605d7cf1.jpg",null)

INSERT INTO film VALUES (3,"L'Criminal Squad : Pantera",'2h 10min',"Action","La suite des aventures de 'Big Nic' O'Brien qui traque les méchants dans les rues d'Europe et se rapproche de la capture de Donnie. Pendant ce temps, ce dernier s'est laissé entraîner dans le monde dangereux des voleurs de diamants et de la mafia des Panthères.","https://fr.web.img4.acsta.net/c_310_420/img/c6/7d/c67d718699bb1158eace4179794b6861.jpg",null)

INSERT INTO film VALUES (4,"Un ours dans le jura",'1h 53min',"Comédie","Michel et Cathy, un couple usé par le temps et les difficultés financières, ne se parle plus vraiment. Jusqu’au jour où Michel, pour éviter un ours sur la route, heurte une voiture et tue les deux occupants. 2 morts et 2 millions en billets usagés dans le coffre, forcément, ça donne envie de se reparler. Et surtout de se taire.","https://fr.web.img5.acsta.net/c_310_420/img/17/5f/175fbcee8f625ac212b06378b2d34435.jpg",null)
