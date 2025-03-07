<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Seance.php';
require_once '../../src/repository/SeanceRepository.php';

$database = new Bdd();
$bdd = $database->getBdd();

if (isset($_POST['ok'])) {
    $idSeance = $_POST['id_seance'];

    if (!empty($idSeance)) {
        $seanceRepository = new SeanceRepository();

        $resultat = $seanceRepository->supprimerSeance($idSeance);

        if ($resultat) {
            echo "Séance supprimée avec succès!";
            header('Location: ../../vue/Catalogue.php');
            exit();
        } else {
            echo "Erreur lors de la suppression de la séance.";
        }
    } else {
        echo "Veuillez spécifier l'ID de la séance.";
    }
}
?>
