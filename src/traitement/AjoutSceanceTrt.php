<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Seance.php';
require_once '../../src/repository/SeanceRepository.php';

$database = new Bdd();
$bdd = $database->getBdd();

if (isset($_POST['ok'])) {
    extract($_POST);
    var_dump($_POST);

    if (!empty($date) && !empty($heure) && isset($nb_place_res) && !empty($ref_salle) && !empty($ref_film)) {

        $donnees = [
            'date' => $_POST['date'],
            'heure' => $_POST['heure'],
            'nb_place_res' => $_POST['nb_place_res'],
            'ref_salle' => $_POST['ref_salle'],
            'ref_film' => $_POST['ref_film']
        ];


        $seance = new Seance($donnees);

        $seanceRepository = new SeanceRepository();
        $resultat = $seanceRepository->ajouterSeance($seance);

        if ($resultat) {
            echo "Séance ajoutée avec succès!";
            header('Location: ../../vue/liste_seances.php');
            exit();
        } else {
            echo "Erreur lors de l'ajout de la séance.";
        }

    } else {
        echo "Tous les champs sont requis.";
    }
}
?>

