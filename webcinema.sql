CREATE DATABASE webcinema;

USE webcinema;

CREATE TABLE UTILISATEUR (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR (50) NOT NULL,
    passe VARCHAR(255) NOT NULL,
    role ENUM('Client', 'Admin') NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE SCEANCE (
    id_sceance INT AUTO_INCREMENT PRIMARY KEY,
    date DATE(14) NOT NULL,
    heure TIME NOT NULL,
    email VARCHAR (50) NOT NULL,
    nb_place_res INT(3) NOT NULL,
    ref_salle INT,
    ref_film INT,
    CONSTRAINT fk_seance_film FOREIGN KEY (ref_film) REFERENCES FILM(id_film) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE SALLE (
    id_salle INT AUTO_INCREMENT PRIMARY KEY,
    nom_salle VARCHAR(50) NOT NULL,
    nb_place INT(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE FILM (
    id_film INT AUTO_INCREMENT PRIMARY KEY,
    nom_film VARCHAR(50) NOT NULL,
    durée VARCHAR (50) NOT NULL,
    genre ENUM('Comédie', 'Drame', 'Thriller', 'Action', 'Horreur', 'Science-fiction', 'Fantastique') NOT NULL,
    description VARCHAR(400),
    image BLOB
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE RESERVATION (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    ref_user INT NOT NULL,
    ref_seance INT NOT NULL,
    nbr_place INT NOT NULL,
    CONSTRAINT fk_reservation_user FOREIGN KEY (ref_user) REFERENCES Users(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_reservation_seance FOREIGN KEY (ref_seance) REFERENCES Seances(id_seance) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;