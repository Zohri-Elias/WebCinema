<?php
require_once "../../src/modele/Film.php";
require_once "../../src/repository/FilmRepository.php";
$filmRepository = new FilmRepository();
$supprimeFilm = new supprime([
    "nomFilm" => $_POST["nom_film"],
    'genre' => $_POST['genre'],
    'description' => $_POST['description'],
    'image' => $_POST['image']
]);

$supprimeFilm = $filmRepository->supprimeFilm($supprimeFilm);

?>
