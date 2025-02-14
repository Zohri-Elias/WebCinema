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
        $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);

        $utilisateur = new Utilisateur([
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'mdp' => $hashedPassword,
        ]);

        $resultat = $utilisateurRepository->inscription($utilisateur);
        if ($resultat) {
            echo "Inscription réussie!";
        } else {
            echo "Erreur lors de l'inscription.";
        }
    } else {
        echo "Email invalide.";
    }
}
?>
