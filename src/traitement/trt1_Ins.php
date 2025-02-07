<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/repository/UtilisateurRepository.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $mdp = $_POST['mdp'] ?? '';
    $role = $_POST['role'] ?? 'utilisateur';

    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($mdp)) {
        $utilisateur = new Utilisateur([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mdp' => $mdp,
            'role' => $role
        ]);

        $bdd = new Bdd();
        $utilisateurRepository = new UtilisateurRepository($bdd);

        if ($utilisateurRepository->inscription($utilisateur)) {
            echo 'Inscription réussie !';
            header('Location: connexion.php');
        } else {
            echo 'Erreur lors de l\'inscription';
        }
    } else {
        echo 'Veuillez remplir tous les champs.';
    }
}
?>
