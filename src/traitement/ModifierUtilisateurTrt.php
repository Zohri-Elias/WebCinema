<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Utilisateur.php';
require_once '../../src/repository/UtilisateurRepository.php';

session_start();

// Vérifiez que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
}

// Créez un objet Utilisateur avec les données du formulaire
$utilisateur = new Utilisateur();
$utilisateur->setNom($_POST['nom']);
$utilisateur->setPrenom($_POST['prenom']);
$utilisateur->setEmail($_POST['email']);
$utilisateur->setMdp($_POST['mdp']);
$utilisateur->setRole($_POST['role']);

// Appelez la méthode pour modifier l'utilisateur
$utilisateurRepository = new UtilisateurRepository();
$resultat = $utilisateurRepository->modifierUtilisateur($utilisateur);

if ($resultat) {
    echo "Profil mis à jour avec succès !";
    header('Location: ../../vue/profil.php');
    exit();
} else {
    echo "Erreur lors de la mise à jour du profil.";
}
?>