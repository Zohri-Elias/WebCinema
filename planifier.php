<?php
$bdd = new PDO('mysql:host=localhost;dbname=webcinema;charset=utf8', 'root', '');

$req = $bdd->prepare('INSERT INTO sceance (date, heure, film) VALUES(:date, :heure, :film)');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['date'], $_POST['heure'], $_POST['film'])) {
        // Sécurisation des données
        $date = htmlspecialchars($_POST['date']);
        $heure = htmlspecialchars($_POST['heure']);
        $film = htmlspecialchars($_POST['film']);

        // Ajout dans la session
        if (!isset($_SESSION['planning'])) {
            $_SESSION['planning'] = [];
        }

        $_SESSION['planning'][] = [
            'date' => $date,
            'heure' => $heure,
            'film' => $film
        ];

        $req->bindParam(':date', $date);
        $req->bindParam(':heure', $heure);
        $req->bindParam(':film', $film);
        $req->execute();
    }
}

header('Location: index.php');
exit;
?>
