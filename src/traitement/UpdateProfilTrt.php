<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    echo "Utilisateur non connecté.";
    exit();
}

require_once '../../src/bdd/Bdd.php';
require_once '../../src/repository/UtilisateurRepository.php';

$database = new Bdd();
$bdd = $database->getBdd();


if (isset($_POST['ok'])) {

    $prenom = isset($_POST['prenom']) && !empty($_POST['prenom']) ? $_POST['prenom'] : null;
    $nom = isset($_POST['nom']) && !empty($_POST['nom']) ? $_POST['nom'] : null;
    $email = isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : null;


    $idUtilisateur = $_SESSION['user_id'];


    if ($prenom) $_SESSION['prenom'] = $prenom;
    if ($nom) $_SESSION['nom'] = $nom;
    if ($email) $_SESSION['email'] = $email;


    $updateFields = [];
    $params = [];

    if ($prenom) {
        $updateFields[] = "prenom = :prenom";
        $params['prenom'] = $prenom;
    }

    if ($nom) {
        $updateFields[] = "nom = :nom";
        $params['nom'] = $nom;
    }

    if ($email) {
        $updateFields[] = "email = :email";
        $params['email'] = $email;
    }


    if (empty($updateFields)) {
        echo "Aucune donnée à mettre à jour.";
        exit();
    }

    // Ajouter l'ID de l'utilisateur
    $updateFields[] = "id_utilisateur = :id_utilisateur";
    $params['id_utilisateur'] = $idUtilisateur;


    $req = "UPDATE utilisateur SET " . implode(", ", $updateFields) . " WHERE id_utilisateur = :id_utilisateur";

    // Préparer et exécuter la requête SQL
    $stmt = $bdd->prepare($req);

    // Exécuter la requête avec les paramètres
    if ($stmt->execute($params)) {
        echo "Mise à jour réussie!";
        header('Location: ../../vue/Profile.php');
        exit();
    } else {
        echo "Une erreur est survenue lors de la mise à jour.";
    }
} else {
    echo "Formulaire non soumis.";
}
