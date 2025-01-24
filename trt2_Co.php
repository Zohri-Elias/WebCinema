<?php

require_once 'Connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];

    $utilisateur = new Connexion($email, $mdp);

    if ($utilisateur->verifierConnexion()) {
        echo "<h1>Connexion réussie !</h1>";
        echo "<p>Bienvenue, " . htmlspecialchars($email) . ".</p>";

    } else {
        echo "<h1>Échec de la connexion</h1>";
        echo "<p>Adresse email ou mot de passe incorrect.</p>";
        echo '<a href="Connexion.html">Retour au formulaire</a>';
    }
}

