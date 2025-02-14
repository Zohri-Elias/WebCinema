<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Utilisateur.php';
require_once '../../src/repository/UtilisateurRepository.php';

session_start();

$database = new Bdd();
$bdd = $database->getBdd();

if (isset($_POST['Co'])) {
    extract($_POST);
    var_dump($_POST);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $utilisateurRepository = new UtilisateurRepository();
        $utilisateur = $utilisateurRepository->connexion($email, $mdp); // Passer les deux arguments ici

        if ($utilisateur && password_verify($mdp, $utilisateur['mdp'])) {
            echo "Bienvenue " . $utilisateur['prenom'] . " !";
            header('Location: ../../index.php');
        } else {
            echo "Email ou mot de passe incorrect.";
            header('Location: ../../vue/Connexion.html');
        }
    } else {
        echo "Email invalide.";
        header('Location: ../../vue/Connexion.html');
    }
}
?>
