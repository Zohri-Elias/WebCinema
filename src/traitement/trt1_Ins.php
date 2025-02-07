<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/repository/UtilisateurRepository.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $mdp = $_POST['mdp'] ?? '';

    $bdd = new Bdd();
    $utilisateurRepository = new UtilisateurRepository($bdd);
    $utilisateur = $utilisateurRepository->connexion($email, $mdp);

    if ($utilisateur) {
        $_SESSION['user'] = [
            'nom' => $utilisateur->getNom(),
            'prenom' => $utilisateur->getPrenom(),
            'email' => $utilisateur->getEmail(),
            'role' => $utilisateur->getRole()
        ];
        header('Location: accueil.php');
    } else {
        echo 'Identifiants incorrects.';
    }
}
?>
