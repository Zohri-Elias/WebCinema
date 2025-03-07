<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Salle.php';
require_once '../../src/repository/SalleRepository.php';

$database = new Bdd();
$bdd = $database->getBdd();

if (isset($_POST['ok'])) {
    // Récupération des données depuis le formulaire
    $nomSalle = $_POST['nom_salle'];
    $nbPlace = $_POST['nb_place'];

    // Vérification que les champs ne sont pas vides
    if (!empty($nomSalle) && !empty($nbPlace)) {
        // Création de l'objet Salle
        $salleRepository = new SalleRepository();
        $salle = new Salle(null, $nomSalle, $nbPlace);  // 'null' pour l'id puisque c'est un nouvel enregistrement

        // Tentative d'ajout de la salle
        $resultat = $salleRepository->ajouterSalle($salle);

        if ($resultat) {
            echo "Ajout réussi!";
            header('Location: ../../vue/Catalogue.php'); // Redirection après ajout
            exit();
        } else {
            echo "Erreur lors de l'ajout de la salle.";
        }
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}
?>
