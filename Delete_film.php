<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si un ID de film est passé dans l'URL
if (isset($_GET['id'])) {
    $film_id = $_GET['id'];

    // Requête SQL pour supprimer le film de la base de données
    $sql = "DELETE FROM films WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $film_id);

    // Exécuter la requête
    if ($stmt->execute()) {
        $message = "Film supprimé avec succès.";
    } else {
        $message = "Erreur lors de la suppression du film : " . $conn->error;
    }

    // Fermer la requête préparée
    $stmt->close();
}

// Récupérer tous les films pour afficher à nouveau la liste
$sql = "SELECT id, title FROM films";
$result = $conn->query($sql);

$films = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $films[] = $row;
    }
}

// Fermer la connexion à la base de données
$conn->close();

// Stocker le message et la liste des films dans la session pour l'affichage dans le fichier HTML
session_start();
$_SESSION['message'] = isset($message) ? $message : '';
$_SESSION['films'] = $films;

// Rediriger vers la page HTML
header('Location: delete_film.html');
exit();
?>
