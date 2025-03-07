<?php

require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Salle.php';
require_once '../../src/repository/SalleRepository.php';

$database = new Bdd();
$bdd = $database->getBdd();

if (isset($_POST['ok'])) {
    // Récupération des données depuis le formulaire
    $idSalle = $_POST['idSalle'];
    $nomSalle = $_POST['nomSalle'];
    $nbPlace = $_POST['nbPlace'];

    // Création de l'objet Salle avec les données
    $salleRepository = new SalleRepository();
    $salle = new Salle($idSalle, $nomSalle, $nbPlace);

    // Tentative de modification de la salle
    $resultat = $salleRepository->modifierSalle($salle);
    if ($resultat) {
        echo "Modification réussie!";
        header('Location: ../../vue/Administration.html');
        exit();
    } else {
        echo "Erreur lors de la modification.";
    }
}
?>
