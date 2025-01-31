<?php

namespace src\repository;

class FilmRepository
{


    private $bdd;

    public function __construct()
    {
        $this->bdd = new PDO('mysql:host=localhost;dbname=webcinema;charset=utf8', 'root', '');
    }

    public function ajoutFilm(FilmRepository $sceance)
    {
        $sql = "INSERT INTO film (nom_film,duree,genre,description) 
                VALUES (:nom_film,:duree,:genre,:description)";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'nom_film' => $sceance->getNom_film(),
            'duree' => $sceance->getDuree(),
            'genre' => $sceance->getGenre(),
            'description' => $sceance->getDescription()
        ));

        if ($res == true) {
            return true;
        } else {
            return false;
        }
    }

    public function modifSceance(Sceance $sceance)
    {
        $sql = "INSERT INTO Livre(titre,annee,resume) 
                VALUES (:titre,:annee,:resume)";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'titre' => $livre->getTitre(),
            'annee' => $livre->getAnnee(),
            'resume' => $livre->getResume(),
        ));
        if ($res == true) {
            return true;
        } else {
            return false;
        }

    }


    public function suppressionSceance(Sceance $sceance)
    {
        $sql = "DELETE FROM Sceance WHERE idSceance = :idSceance";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'idSceance' => $sceance->getIdSceance()
        ));
        if ($res == true) {
            return true;
        } else {
            return false;
        }
    }
}