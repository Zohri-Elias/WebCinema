<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Seance.php';
require_once '../../src/repository/SeanceRepository.php';

$database = new Bdd();
$bdd = $database->getBdd();

if (isset($_POST['ok'])) {
    // Vérifier que les variables sont bien envoyées via POST
    if (isset($_POST['id_seance'], $_POST['date_seance'], $_POST['id_film'], $_POST['id_salle'])) {
        // Extraire les données envoyées par le formulaire
        $id_seance = $_POST['id_seance'];
        $date_seance = $_POST['date_seance'];
        $id_film = $_POST['id_film'];
        $id_salle = $_POST['id_salle'];

        // S'assurer que les données ne sont pas vides
        if (!empty($id_seance) && !empty($date_seance) && !empty($id_film) && !empty($id_salle)) {
            // Créer l'objet Seance avec les données récupérées
            $seanceRepository = new SeanceRepository();
            $seance = new Seance([
                'id_seance' => $id_seance,
                'date' => $date_seance,
                'heure' => date('H:i'),  // Ici on peut soit récupérer l'heure spécifiquement, soit la définir par défaut
                'nb_place_res' => 0,     // Par défaut, on peut initialiser à 0
                'ref_salle' => $id_salle,
                'ref_film' => $id_film,
            ]);

            // Appel à la méthode pour modifier la séance dans la base de données
            $resultat = $seanceRepository->modifierSeance($seance);

            if ($resultat) {
                echo "Séance modifiée avec succès!";
                header('Location: ../../vue/Catalogue.php');
                exit();
            } else {
                echo "Erreur lors de la modification de la séance.";
            }
        } else {
            echo "Tous les champs sont obligatoires.";
        }
    } else {
        echo "Veuillez remplir tous les champs nécessai
