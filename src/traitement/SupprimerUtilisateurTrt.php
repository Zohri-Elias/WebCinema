<?php

require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Utilisateur.php';
require_once '../../src/repository/UtilisateurRepository.php';

if (isset($_POST['ok'])) {
    extract($_POST);
    var_dump($_POST);


    if (isset($_POST['ok']) && isset($_POST['idUtilisateur'])) {
        $idFilm = intval($_POST['idUtilisateur']);

        $utilisateurRepository = new utilisateurRepository();
        $utilisateur = new Utilisateur([
            'idUtilisateur' => $idUtilisateur,
        ]);

        $resultat = $utilisateurRepository->supprimerUtilisateur($utilisateur);

        if ($resultat) {
            echo "Film supprimé avec succès!";
            header('Location: ../../vue/Administration.html');
            exit();
        } else {
            echo "Erreur lors de la suppression du film.";
        }
    } else {
        echo "Données invalides.";
    }
}
?>