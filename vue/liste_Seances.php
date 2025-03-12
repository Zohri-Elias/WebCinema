<?php
require_once '../src/bdd/Bdd.php';

// Connexion à la base de données
$database = new Bdd();
$bdd = $database->getBdd();

// Récupérer les séances depuis la base de données
try {
    $sql = "SELECT id_seance, date, heure, nb_place_res, ref_salle, ref_film FROM Seance";
    $stmt = $bdd->query($sql);
    $seances = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des séances : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Séances</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .home-button {
            display: inline-block;
            margin: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .home-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h2>Liste des Séances</h2>
<a href="catalogue.php" class="home-button">Home</a>
<a href="Administration.html" class="home-button">Admin</a>
<table>
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Heure</th>
        <th>Places restantes</th>
        <th>Salle</th>
        <th>Film</th>
    </tr>
    <?php foreach ($seances as $seance): ?>
        <tr>
            <td><?= htmlspecialchars($seance['id_seance']) ?></td>
            <td><?= htmlspecialchars($seance['date']) ?></td>
            <td><?= htmlspecialchars($seance['heure']) ?></td>
            <td><?= htmlspecialchars($seance['nb_place_res']) ?></td>
            <td><?= htmlspecialchars($seance['ref_salle']) ?></td>
            <td><?= htmlspecialchars($seance['ref_film']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
