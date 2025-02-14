<?php
require_once "../../src/modele/Film.php";
require_once "../../src/repository/FilmRepository.php";
$filmRepository = new FilmRepository();
$film = new Film([
    "nomFilm" => $_POST["nom_film"],
    'genre' => $_POST['genre'],
    'description' => $_POST['description'],
    'image' => $_POST['image']
]);

$films = $filmRepository->ajoutFilm($film);

?>
