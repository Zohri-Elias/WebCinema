<?php

class FilmRepository
{
    private $bdd;
    private $film;
    public function __construct()
    {
    $this->bdd = new PDO('mysql:host=localhost;dbname=webcinema', 'root', '');
    }
    public function ajoutFilm(Film $film)
    {
        $sql = "INSERT INTO film (nom_film,genre,description,image) VALUES (:nom_film,:genre,:description,:image)";
        $req = $this->bdd->prepare($sql);
        $req->execute(array(
            'nom_film' => $film->getNomFilm(),
            'genre' => $film->getGenre(),
            'description' =>$film->getDescription(),
            'image' => $film->getImage()
        ));

        if ($req == true) {
            return true;
        } else {
            return false;
        }
    }

//    public function deleteFilm(FilmRepository $supprimer)
//     {
    //        $AAA = "DELETE from film WEHRE (nom_film = :nom_film, duree = :duree, genre = :genre, description = :description, image = :image";
    //        $requ = $this->bdd->getBdd()->prepare($AAA);
    //        $resu = $requ->execute(array(
//             'nom_film' => $supprimer->getNom_film(),
    //            'duree' => $supprimer->getDuree(),
    //           'genre' => $supprimer->getGenre(),
    //          'description' => $supprimer->getDescription(),
    //           'image' => $supprimer->getImage()
    //       ));

    //        if ($resu == true) {
    //       return true;
    //       } else {
    //           return false;
    //       }
    //  }



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
