<?php
// Démarre la session pour accéder au planning
session_start();

// Vérifie si l'événement à modifier est bien passé en paramètre
if (isset($_GET['edit'])) {
    $edit_index = $_GET['edit'];

    // Vérifie si l'index existe dans le planning de la session
    if (isset($_SESSION['planning'][$edit_index])) {
        // Récupère les données de l'événement
        $event = $_SESSION['planning'][$edit_index];
    } else {
        die("L'événement à modifier n'a pas été trouvé.");
    }
} else {
    die("Aucun événement à modifier.");
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des nouvelles données
    $jour = htmlspecialchars($_POST['jour']);
    $heure = htmlspecialchars($_POST['heure']);
    $activite = htmlspecialchars($_POST['activite']);

    // Mise à jour de l'événement dans le planning
    $_SESSION['planning'][$edit_index] = [
        'jour' => $jour,
        'heure' => $heure,
        'activite' => $activite
    ];

    // Redirige vers la page principale après la modification
    header('Location: index.php');
    exit;
}
?>
