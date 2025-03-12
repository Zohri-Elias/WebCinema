<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Séance</title>
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
        .sidebar-menu {
            list-style-type: none;
            padding: 0;
        }
        .sidebar-menu li {
            padding: 15px;
            text-align: center;
            color: white;
            cursor: pointer;
            transition: background 0.3s;
        }
        .sidebar-menu li:hover {
            background-color: #555;
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
        .form-container input, .form-container select, .form-container button {
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
        <li onclick="window.location.href='ajout_film.html'">Ajouter un film</li>
        <li onclick="window.location.href='ajout_seance.html'">Ajouter une séance</li>
    </ul>
</div>

<div class="content">
    <h1>Ajouter une Séance</h1>
    <div class="form-container">
        <form action="../src/traitement/AjoutSceanceTrt.php" method="POST">
            <label for="date">Date :</label>
            <input type="date" id="date" name="date" required>

            <label for="heure">Heure :</label>
            <input type="time" id="heure" name="heure" required>

            <label for="nb_place_res">Nombre de places restantes :</label>
            <input type="number" id="nb_place_res" name="nb_place_res" required>

            <label for="ref_salle">Référence Salle :</label>
            <input type="number" id="ref_salle" name="ref_salle" required>

            <label for="ref_film">Référence Film :</label>
            <input type="number" id="ref_film" name="ref_film" required>

            <button type="submit" name="ok">Ajouter la Séance</button>
        </form>
    </div>

    <h2>Liste des Séances</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Nombre de places restantes</th>
            <th>Référence Salle</th>
            <th>Référence Film</th>
        </tr>

        <?php
        require_once '../src/bdd/Bdd.php';
        $database = new Bdd();
        $bdd = $database->getBdd();

        $sql = "SELECT id_seance, date, heure, nb_place_res, ref_salle, ref_film FROM Seance";
        $stmt = $bdd->query($sql);

        while ($seance = $stmt->fetch()) {
            echo "<tr>
                    <td>" . htmlspecialchars($seance['id_seance']) . "</td>
                    <td>" . htmlspecialchars($seance['date']) . "</td>
                    <td>" . htmlspecialchars($seance['heure']) . "</td>
                    <td>" . htmlspecialchars($seance['nb_place_res']) . "</td>
                    <td>" . htmlspecialchars($seance['ref_salle']) . "</td>
                    <td>" . htmlspecialchars($seance['ref_film']) . "</td>
                  </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
