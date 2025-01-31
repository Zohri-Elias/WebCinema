<?php

use src\modele\Inscription;

require_once __DIR__ . '/src/modele/Inscription.php';
$utilisateur = new Inscription($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["mdp"]);
$utilisateur->inscrire();
