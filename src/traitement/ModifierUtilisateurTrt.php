<?php

require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Utilisateur.php';
require_once '../../src/repository/UtilisateurRepository.php';


$database = new Bdd();
$bdd = $database->getBdd();

if (isset($_POST['ok'])) {
    extract($_POST);
    var_dump($_POST);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $utilisateurRepository = new UtilisateurRepository();
        $utilisateur = new Utilisateur([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mdp' => $mdp,
        ]);

        $resultat = $utilisateurRepository->modifierUtilisateur($utilisateur);
        if ($resultat) {
            echo "Inscription réussie!";
            header('Location: ../../vue/Connexion.html');
        } else {
            echo "Erreur lors de l'inscription.";
        }
    } else {
        echo "Email invalide.";
    }
}
?>