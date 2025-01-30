<?php
$bdd = new PDO('mysql:host=localhost;dbname=test', $user, $pass);

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['jour'], $_POST['heure'], $_POST['activite'])) {
        $jour = htmlspecialchars($_POST['jour']);
        $heure = htmlspecialchars($_POST['heure']);
        $activite = htmlspecialchars($_POST['activite']);

        if (!isset($_SESSION['planning'])) {
            $_SESSION['planning'] = [];
        }

        $_SESSION['planning'][] = [
            'jour' => $jour,
            'heure' => $heure,
            'activite' => $activite
        ];
    }
}

header('Location: index.php');
exit;
?>
