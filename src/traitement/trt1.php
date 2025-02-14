<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Utilisateur.php';
require_once '../../src/repository/UtilisateurRepository.php';


$database = new Bdd();
$bdd = $database->getBdd();

if(isset($_POST['ok'])) {
    extract($_POST);
    var_dump($_POST);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $utilisateurRepository = new UtilisateurRepository();
        $utilisateur = new Utilisateur([
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'mdp' => $mdp,

        ]);
        $resultat = $utilisateurRepository->inscription($utilisateur);


    }
}
?>
