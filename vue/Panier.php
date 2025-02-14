<?php
session_start();
require_once "../src/bdd/Bdd.php";
require_once "../src/modele/Film.php";
require_once "../src/repository/FilmRepository.php";
require_once "../src/repository/reservationRepository.php";
$filmRepository = new FilmRepository();
$films = $filmRepository->afficherCatalogue();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Mon Panier</h2>
    <!-- Bouton retour modifié pour renvoyer vers catalogue.php -->
    <a href="catalogue.php" class="btn btn-secondary mb-3">Retour au Catalogue</a>
    <table class="table">
        <thead>
        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Vérifie si le panier existe
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        // Ajout d'un film au panier
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajouter_panier'])) {
            $id_film = $_POST['id_film'];
            $film_nom = $_POST['film_nom'];
            $film_image = $_POST['film_image'];

            // Vérifier si le film est déjà dans le panier
            $dejaDansPanier = false;
            foreach ($_SESSION['panier'] as $film) {
                if ($film["id"] == $id_film) {
                    $dejaDansPanier = true;
                    break;
                }
            }

            if (!$dejaDansPanier) {
                $_SESSION['panier'][] = [
                    "id" => $id_film,
                    "nom" => $film_nom,
                    "image" => $film_image
                ];
            }
        }

        // Suppression d'un film du panier
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['supprimer_id'])) {
            $idASupprimer = $_POST['supprimer_id'];

            foreach ($_SESSION['panier'] as $index => $film) {
                if ($film["id"] == $idASupprimer) {
                    unset($_SESSION['panier'][$index]);
                    $_SESSION['panier'] = array_values($_SESSION['panier']); // Réindexer le tableau
                    break;
                }
            }
        }

        // Affichage du panier
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Panier - Movie Room</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>

        <div class="container mt-5">
            <h2 class="mb-4">Votre Panier</h2>

            <?php if (empty($_SESSION['panier'])) : ?>
                <p class="text-muted">Votre panier est vide.</p>
            <?php else : ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom du film</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($_SESSION['panier'] as $film) : ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($film['image']) ?>" alt="<?= htmlspecialchars($film['nom']) ?>" width="80"></td>
                            <td><?= htmlspecialchars($film['nom']) ?></td>
                            <td>
                                <form method="POST" action="Panier.php">
                                    <input type="hidden" name="supprimer_id" value="<?= htmlspecialchars($film['id']) ?>">
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>

</body>
</html>
