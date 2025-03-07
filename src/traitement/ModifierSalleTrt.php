<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Salle.php';
require_once '../../src/repository/SalleRepository.php';

session_start();

// Vérifiez que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
}

// Créez un objet Salle avec les données du formulaire
$salle = new Salle();
$salle->setNomSalle($_POST['nomSalle']);
$salle->setNbSalle($_POST['nbPlace']);

// Appelez la méthode pour modifier la salle
$salleRepository = new SalleRepository();
$resultat = $salleRepository->modifiersalle($salle);

if ($resultat) {
    echo "Profil mis à jour avec succès !";
    header('Location: ../../../vue/administration.html');
    exit();
} else {
    echo "Erreur lors de la mise à jour du profil.";
}
?>