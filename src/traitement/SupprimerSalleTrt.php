<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Salle.php';
require_once '../../src/repository/SalleRepository.php';

$database = new Bdd();
$bdd = $database->getBdd();

if (isset($_POST['ok'])) {
    // Récupération de l'ID de la salle à supprimer
    $idSalle = $_POST['id_salle'];

    if (!empty($idSalle)) {
        // Création du repository
        $salleRepository = new SalleRepository();

        // Tentative de suppression de la salle
        $resultat = $salleRepository->supprimerSalle($idSalle);

        if ($resultat) {
            echo "Salle supprimée avec succès!";
            header('Location: ../../vue/Catalogue.php'); // Redirection après suppression
            exit();
        } else {
            echo "Erreur lors de la suppression de la salle.";
        }
    } else {
        echo "Veuillez spécifier l'ID de la salle.";
    }
}
?>
