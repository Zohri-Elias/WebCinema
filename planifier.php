<?php
// Démarre la session pour pouvoir stocker les informations
session_start();

// Si le formulaire est soumis, traiter les données
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification des données envoyées
    if (isset($_POST['jour'], $_POST['heure'], $_POST['activite'])) {
        $jour = htmlspecialchars($_POST['jour']);
        $heure = htmlspecialchars($_POST['heure']);
        $activite = htmlspecialchars($_POST['activite']);

        // Si la session planning n'existe pas encore, on l'initialise
        if (!isset($_SESSION['planning'])) {
            $_SESSION['planning'] = [];
        }

        // Ajouter la nouvelle entrée au planning
        $_SESSION['planning'][] = [
            'jour' => $jour,
            'heure' => $heure,
            'activite' => $activite
        ];
    }
}

// Rediriger vers la page principale pour éviter la soumission multiple du formulaire
header('Location: index.php');
exit;
?>
