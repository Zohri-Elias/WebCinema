<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Film.php';
require_once '../../src/repository/FilmRepository.php';

$database = new Bdd();
$bdd = $database->getBdd();

if (isset($_POST['ok'])) {
    extract($_POST);
    var_dump($_POST);

    if (!empty($nom_film) && !empty($genre) && !empty($description) && !empty($duree) && !empty($image)) {
        $filmRepository = new FilmRepository();

        $film = new Film($_POST);
        $film->setNomFilm($_POST['nom_film']);
        $film->setGenre($_POST['genre']);
        $film->setDescription($_POST['description']);
        $film->setDuree($_POST['duree']);
        $film->setImage($_POST['image']);


        $resultat = $filmRepository->ajouterFilm($film);

        if ($resultat) {
            echo "Ajout réussi!";
            header('Location: ../../vue/Catalogue.php');
            exit();
        } else {
            echo "Erreur lors de l'ajout du film.";
        }
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}
?>
