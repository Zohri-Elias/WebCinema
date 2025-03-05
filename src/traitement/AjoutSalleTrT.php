<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Salle.php';
require_once '../../src/repository/SalleRepository.php';

$database = new Bdd();
$bdd = $database->getBdd();

if (isset($_POST['ok'])) {
    extract($_POST);
    var_dump($_POST);

    if (!empty($nom_salle) && !empty($nb_place)) {
        $salleRepository = new SalleRepository();

        $film = new Salle($_POST);
        $film->setNomSalle($_POST['nom_salle']);
        $film->setNbPlace($_POST['nb_place']);


        $resultat = $filmRepository->ajouterSalle($film);

        if ($resultat) {
            echo "Ajout réussi!";
            header('Location: ../../vue/Catalogue.php');
            exit();
        } else {
            echo "Erreur lors de l'ajout de la salle.";
        }
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}
?>