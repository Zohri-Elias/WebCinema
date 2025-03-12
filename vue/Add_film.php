<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Film</title>
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
        .form-container input, .form-container textarea, .form-container button {
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
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">MATERIAL ADMIN PRO</div>
    <ul class="sidebar-menu">
        <li onclick="window.location.href='../src/traitement/AjoutFilmTrT.php'">Ajouter un film</li>
        <li onclick="window.location.href='modify_film.html'">Modifier un film</li>
    </ul>
</div>

<div class="content">
    <h1>Ajouter un Film</h1>
    <div class="form-container">
        <form action="../src/traitement/AjoutFilmTrT.php" method="POST">
            <label for="nom_film">Titre du film :</label>
            <input type="text" id="nom_film" name="nom_film" required>

            <label for="description">Description :</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="genre">Type de film :</label>
            <input type="text" id="genre" name="genre" required>

            <label for="duree">Durée du film :</label>
            <input type="number" id="duree" name="duree" required>

            <label for="image">Image du film (URL) :</label>
            <input type="url" id="image" name="image" required>

            <button type="submit" name="ok">Ajouter le film</button>
        </form>
    </div>

    <h2>Liste des Films</h2>
    <table>
        <thead>
        <tr>
            <th>ID Film</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Genre</th>
            <th>Durée</th>
            <th>Image</th>
        </tr>
        </thead>
        <tbody>
        <?php
            require_once '../src/bdd/Bdd.php';
            $database = new Bdd();
            $bdd = $database->getBdd();

        $sql = "SELECT id_film, nom_film, description, genre, duree, image FROM Film";
        $stmt = $bdd->query($sql);

        while ($film = $stmt->fetch()) {
        echo "<tr>
            <td>" . htmlspecialchars($film['id_film']) . "</td>
            <td>" . htmlspecialchars($film['nom_film']) . "</td>
            <td>" . htmlspecialchars($film['description']) . "</td>
            <td>" . htmlspecialchars($film['genre']) . "</td>
            <td>" . htmlspecialchars($film['duree']) . " min</td>
            <td><img src='" . htmlspecialchars($film['image']) . "' alt='" . htmlspecialchars($film['nom_film']) . "' width='100'></td>
        </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
