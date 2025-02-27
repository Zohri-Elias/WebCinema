<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Film.php';
require_once '../../src/repository/FilmRepository.php';

if (isset($_POST['ok']) && isset($_POST['id_film'])) {
    $idFilm = intval($_POST['id_film']);

    $filmRepository = new FilmRepository();

    $resultat = $filmRepository->supprimerFilm($idFilm);

    if ($resultat) {
        echo "Film supprimé avec succès!";
        header('Location: ../../vue/Catalogue.php');
        exit();
    } else {
        echo "Erreur lors de la suppression du film.";
    }
} else {
    echo "Données invalides.";
}
?>
