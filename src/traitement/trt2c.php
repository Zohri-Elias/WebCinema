<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Utilisateur.php';
require_once '../../src/repository/UtilisateurRepository.php';

session_start();
var_dump($_POST);
if (isset($_POST['Co'])) {
    extract($_POST);
    var_dump($email);
    var_dump($mdp);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $utilisateurRepository = new UtilisateurRepository();
        $utilisateur = $utilisateurRepository->connexion($email, $mdp); // Passer les deux arguments ici

        if (isset($utilisateur["id_utilisateur"])) {
            echo "Bienvenue " . $utilisateur['prenom'] . " !";
            header('Location: ../../index.php');
            exit();
        } else {
            echo "Email ou mot de passe incorrect.";
            header('Location: ../../vue/Connexion.html');
            exit();
        }
    } else {
        echo "Email invalide.";
        header('Location: ../../vue/Connexion.html');
        exit();
    }
}
?>
