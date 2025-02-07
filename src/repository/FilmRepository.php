<?php

class FilmRepository
{
    private $bdd;
    private $film;
    public function __construct()
    {
    $this->bdd = new PDO('mysql:host=localhost;dbname=films', 'root', '');
    }

    public function ajoutFilm(FilmRepository $sceance)
    {
        $sql = "INSERT INTO film (nom_film,duree,genre,description) VALUES (:nom_film,:duree,:genre,:description)";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'nom_film' => $sceance->getNom_film(),
            'duree' => $sceance->getDuree(),
            'genre' => $sceance->getGenre(),
            'description' => $sceance->getDescription(),
            'image' => $sceance->getImage()
        ));

        if ($res == true) {
            return true;
        } else {
            return false;
        }
    }

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
