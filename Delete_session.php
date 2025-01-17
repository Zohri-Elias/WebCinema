<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Suppression d'une séance si un ID est passé via GET
if (isset($_GET['id'])) {
    $session_id = $_GET['id'];

    $sql = "DELETE FROM sessions WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $session_id);

    if ($stmt->execute()) {
        echo "Séance supprimée avec succès.";
    } else {
        echo "Erreur lors de la suppression de la séance : " . $conn->error;
    }
}

// Récupération de toutes les séances pour affichage
$sql = "SELECT sessions.id, films.title, sessions.date, sessions.time 
        FROM sessions 
        INNER JOIN films ON sessions.film_id = films.id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer une Séance</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .content {
            margin-left: 250px;
            padding: 40px;
        }
        .session-list {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            font-size: 1em;
            border-radius: 6px;
        }
        button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="content">
    <h1>Supprimer une Séance</h1>
    <div class="session-list">
        <h2>Liste des séances</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Film</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['time'] . "</td>";
                    echo "<td><a href='delete_session.php?id=" . $row['id'] . "'><button>Supprimer</button></a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucune séance trouvée.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
