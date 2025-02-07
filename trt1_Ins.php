<?php

require_once 'Bdd.php';
require_once 'Utilisateur.php';
require_once 'UtilisateurRepository.php';

$bdd = new Bdd();
$userRepo = new UtilisateurRepository($bdd);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (isset($_POST['register'])) {
$user = new Utilisateur($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp']);
if ($userRepo->register($user)) {
echo "Inscription réussie.";
} else {
echo "Erreur lors de l'inscription.";
}
}

if (isset($_POST['login'])) {
$user = $userRepo->login($_POST['email'], $_POST['mdp']);
if ($user) {
session_start();
$_SESSION['user'] = $user->getEmail();
echo "Connexion réussie.";
} else {
echo "Identifiants incorrects.";
}
}
}
?>
