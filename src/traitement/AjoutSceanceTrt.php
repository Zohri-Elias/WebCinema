<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Seance.php';
require_once '../../src/repository/SeanceRepository.php';

// Connexion à la base de données
$database = new Bdd();
$bdd = $database->getBdd();

// Traitement lorsque le formulaire est soumis
if (isset($_POST['ok'])) {
    // Récupération des données du formulaire
    $date_seance = $_POST['date_seance'] ?? '';
    $id_film = $_POST['id_film'] ?? '';
    $id_salle = $_POST['id_salle'] ?? '';

    // Vérification que tous les champs sont remplis
    if (!empty($date_seance) && !empty($id_film) && !empty($id_salle)) {
        $seanceRepository = new SeanceRepository();

        // Création de l'objet Seance
        $seance = new Seance([
            'date' => $date_seance,
            'heure' => substr($date_seance, 11), // Heure extraite de la date et heure
            'ref_film' => $id_film,
            'ref_salle' => $id_salle,
            'nb_place_res' => 0 // Valeur initiale pour les réservations
        ]);

        // Ajouter la séance dans la base de données
        $resultat = $seanceRepository->ajouterSeance($seance);

        // Vérification du résultat de l'ajout
        if ($resultat) {
            echo "Séance ajoutée avec succès!";
            // Redirection vers le catalogue
            header('Location: ../../vue/Catalogue.php');
            exit();
        } else {
            echo "Erreur lors de l'ajout de la séance.";
        }
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}
?>
