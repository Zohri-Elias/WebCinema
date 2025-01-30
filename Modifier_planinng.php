<?php
session_start();

if (isset($_GET['edit'])) {
    $edit_index = $_GET['edit'];

    if (isset($_SESSION['planning'][$edit_index])) {
        // Récupère les données de l'événement
        $event = $_SESSION['planning'][$edit_index];
    } else {
        die("L'événement à modifier n'a pas été trouvé.");
    }
} else {
    die("Aucun événement à modifier.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jour = htmlspecialchars($_POST['jour']);
    $heure = htmlspecialchars($_POST['heure']);
    $activite = htmlspecialchars($_POST['activite']);

    $_SESSION['planning'][$edit_index] = [
        'jour' => $jour,
        'heure' => $heure,
        'activite' => $activite
    ];

    header('Location: index.php');
    exit;
}
?>
