<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Film</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            border-right: 1px solid #444;
            position: fixed;
            overflow-y: auto;
            padding-top: 20px;
        }
        .sidebar-header {
            padding: 20px;
            font-size: 1.5em;
            font-weight: bold;
            color: white;
            text-align: center;
            background-color: #222;
        }
        .content {
            margin-left: 250px;
            padding: 40px;
        }
        h1 {
            font-size: 2em;
            color: #444;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 60%;
            margin: auto;
        }
        .form-container input, .form-container textarea, .form-container select, .form-container button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1em;
        }
        .form-container button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">MATERIAL ADMIN PRO</div>
    <ul class="sidebar-menu">
        <li onclick="window.location.href='add_film.html'">Ajouter un film</li>
        <li onclick="window.location.href='modify_film.html'">Modifier un film</li>
    </ul>
</div>

<div class="content">
    <h1>Modifier un Film</h1>
    <div class="form-container">
        <form action="../src/traitement/ModifierFilmTrt.php" method="POST" enctype="multipart/form-data">
            <label for="film-id">ID du film :</label>
            <input type="text" id="film-id" name="id_film" required>

            <label for="film-title">Titre du film :</label>
            <input type="text" id="film-title" name="nom_film" required>

            <label for="film-genre">Genre :</label>
            <input type="text" id="film-genre" name="genre" required>

            <label for="film-description">Description :</label>
            <textarea id="film-description" name="description" rows="4" required></textarea>

            <label for="film-duration">Durée (en minutes) :</label>
            <input type="number" id="film-duration" name="duree" required>

            <label for="film-image">Nouvelle image (optionnel) :</label>
            <input type="file" id="film-image" name="image" accept="image/*">

            <button type="submit" name="ok">Modifier le film</button>

            <a href="Administration.html">Retour</a>
        </form>
    </div>

    <h2>Liste des Films</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom du film</th>
            <th>Genre</th>
            <th>Durée</th>
            <th>Date de sortie</th>
            <th>Réalisateur</th>
        </tr>
        <?php
        require_once '../src/bdd/Bdd.php';
        $database = new Bdd();
        $bdd = $database->getBdd();

        $sql = "SELECT id_film, nom_film, genre, duree, description FROM film";
        $stmt = $bdd->query($sql);

        while ($film = $stmt->fetch()) {
            echo "<tr><td>" . htmlspecialchars($film['id_film']) . "</td><td>" . htmlspecialchars($film['nom_film']) . "</td><td>" . htmlspecialchars($film['genre']) . "</td><td>" . htmlspecialchars($film['duree']) . "</td><td>" . htmlspecialchars($film['description']) . "</td><td>" ;    }
        ?>
    </table>
</div>


</body>
</html>
