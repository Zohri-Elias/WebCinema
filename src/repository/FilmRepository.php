<?php

class FilmRepository
{
    private $bdd;
    private $film;
    public function __construct()
    {
    $this->bdd = new PDO('mysql:host=localhost;dbname=webcinema', 'root', '');
    }
    public function ajouterFilm(Film $film)
    {
        $sql = "INSERT INTO film (nom_film, genre, description, duree, image) 
            VALUES (:nom_film, :genre, :description, :duree, :image)";

        $req = $this->bdd->prepare($sql);

        $result = $req->execute(array(
            'nom_film' => $film->getNomFilm(),
            'genre' => $film->getGenre(),
            'description' => $film->getDescription(),
            'duree' => $film->getDuree(),
            'image' => $film->getImage()
        ));

        if ($result) {
            return true;
        } else {
            return false;
        }


}

    public function supprimerFilm($idFilm)
    {
        $sql = "DELETE FROM film WHERE id_film = :id_film";

        $req = $this->bdd->prepare($sql);

        $result = $req->execute(array(
            'id_film' => $idFilm
        ));

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function modifierFilm(Film $film)
    {
        $sql = "UPDATE film 
                SET nom_film = :nom_film, genre = :genre, description = :description, 
                    duree = :duree,image = COALESCE(NULLIF(:image, ''), image)

                WHERE id_film = :id_film";

        $req = $this->bdd->prepare($sql);
        $req->execute([
            'id_film' => $film->getIdFilm(),
            'nom_film' => $film->getNomFilm(),
            'genre' => $film->getGenre(),
            'description' => $film->getDescription(),
            'duree' => $film->getDuree(),
            'image' => $film->getImage()
        ]);

        return $req->rowCount() > 0;
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
