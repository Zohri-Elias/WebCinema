<?php
session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajouter_panier'])) {
    $id_film = $_POST['id_film'];
    $film_nom = $_POST['film_nom'];
    $film_image = $_POST['film_image'];

    // Vérifie si le film est déjà dans le panier
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

    header("Location: catalogue.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Confirmer_id'])) {
    $idAConfirmer = $_POST['Confirmer_id'];

    $_SESSION['panier'] = array_values(array_filter($_SESSION['panier'], function ($film) use ($idAConfirmer) {
        return $film["id"] != $idAConfirmer;
    }));
    header("Location: Confirmer.php");
    exit();
}

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['supprimer_id'])) {
        $idASupprimer = $_POST['supprimer_id'];

        $_SESSION['panier'] = array_values(array_filter($_SESSION['panier'], function ($film) use ($idASupprimer) {
            return $film["id"] != $idASupprimer;
        }));

        header("Location: Panier.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panier - Movie Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Votre Panier</h2>
    <a href="catalogue.php" class="btn btn-secondary mb-3">Retour au Catalogue</a>

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
                    <td><img src="<?= htmlspecialchars($film['image']) ?>" width="80"></td>
                    <td><?= ($film['nom']) ?></td>
                    <td>
                        <form method="POST" action="Panier.php">
                            <input type="hidden" name="supprimer_id" value="<?= ($film['id']) ?>">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                        <form method="POST" action="Panier.php">
                            <input type="hidden" name="Confirmer_id" value="<?= ($film['id']) ?>">
                            <button type="submit" class="btn btn-success">Confirmer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
