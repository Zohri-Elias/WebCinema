<?php

require_once '../../src/bdd/Bdd.php';
require_once '../../src/repository/FilmRepository.php';
require_once '../../src/modele/Film.php';

$database = new Bdd();
$bdd = $database->getBdd();

$filmRepository = new FilmRepository($bdd);

if (isset($_POST['ok'])) {
    extract($_POST);


    if (!isset($id_film) || empty($id_film)) {
        echo "L'ID du film est requis.";
        exit();
    }

    $image = isset($image) && !empty($image) ? $image : null;


    $film = new Film([
        'idFilm' => $id_film,
        'nomFilm' => $nom_film,
        'genre' => $genre,
        'description' => $description,
        'duree' => $duree,
        'image' => $image
    ]);


    $success = $filmRepository->modifierFilm($film);


    if ($success) {
        echo "Modification réussie!";
        header('Location: ../../vue/Catalogue.php');
        exit();
    } else {
        echo "Aucune modification effectuée. Assurez-vous que l'ID du film est correct.";
    }
} else {
    echo "Formulaire non soumis.";
}

?>
