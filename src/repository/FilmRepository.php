<?php

<<<<<<< HEAD
<<<<<<< HEAD
namespace src\repository;
=======
use src\modele\Film;

require_once $_SERVER['DOCUMENT_ROOT'] . "/exo/WebCinema/src/bdd/Bdd.php";
>>>>>>> 3f92270365e90ea35c189a5d5aa4d4fc1aaac589

=======
>>>>>>> 0109e40bdc20fcec241f0cec61b5dad3645eabf7
class FilmRepository
{

<<<<<<< HEAD

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
=======
    public function afficherCatalogue()
    {
        $films=[];
        $bdd = new Bdd();
        $connexion = $bdd->getbdd();
        $filmsBdd = $connexion->query("SELECT * FROM film ORDER BY id_film")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($filmsBdd as $film) {
            $films[]= new Film([
                "idFilm"=>$film['id_film'],
                "nomFilm"=>$film['nom_film'],
                "duree"=>$film['duree'],
                "genre"=>$film['genre'],
                "description"=>$film['description'],
                "image"=>$film['image'],

            ]);
        }
        return $films;
    }
}
// port=3307;
?>
>>>>>>> 3f92270365e90ea35c189a5d5aa4d4fc1aaac589
