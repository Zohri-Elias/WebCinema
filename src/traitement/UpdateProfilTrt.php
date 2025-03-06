<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Utilisateur non connecté.";
    exit();
}

require_once '../../src/bdd/Bdd.php';

$database = new Bdd();
$bdd = $database->getBdd();

if (isset($_POST['ok'])) {
    $prenom = isset($_POST['prenom']) && !empty($_POST['prenom']) ? $_POST['prenom'] : null;
    $nom = isset($_POST['nom']) && !empty($_POST['nom']) ? $_POST['nom'] : null;
    $email = isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : null;
    $mdp = isset($_POST['mdp']) && !empty($_POST['mdp']) ? $_POST['mdp'] : null;

    // Récupération de l'ID utilisateur depuis la session
    $idUtilisateur = $_SESSION['user_id'];

    // Mise à jour de la session avec les nouvelles données (prénom, nom, email)
    if ($prenom) $_SESSION['prenom'] = $prenom;
    if ($nom) $_SESSION['nom'] = $nom;
    if ($email) $_SESSION['email'] = $email;

    // Si un mot de passe est fourni, on le hache avant de le mettre à jour
    if ($mdp) {
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);  // Hachage du mot de passe
    }

    // On prépare la requête de mise à jour
    $updateFields = [];
    $params = ['id_utilisateur' => $idUtilisateur];

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

    if ($mdp) {
        $updateFields[] = "mdp = :mdp";
        $params['mdp'] = $mdp;
    }

    if (empty($updateFields)) {
        echo "Aucune donnée à mettre à jour.";
        exit();
    }

    // Construction de la requête SQL
    $req = "UPDATE utilisateur SET " . implode(", ", $updateFields) . " WHERE id_utilisateur = :id_utilisateur";

    // Préparation et exécution de la requête SQL
    $stmt = $bdd->prepare($req);

    if ($stmt->execute($params)) {
        echo "Mise à jour réussie!";
        // Redirection après la mise à jour
        header('Location: ../../vue/Profile.php');
        exit();
    } else {
        echo "Une erreur est survenue lors de la mise à jour.";
    }
} else {
    echo "Formulaire non soumis.";
}
