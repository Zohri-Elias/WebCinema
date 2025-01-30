<?php

use src\modele\Inscription;

require_once 'Inscription.php';
$utilisateur = new Inscription($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["mdp"]);
$utilisateur->inscrire();
