<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $film_id = $_GET['id'];

    $sql = "DELETE FROM films WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $film_id);

    if ($stmt->execute()) {
        $message = "Film supprimé avec succès.";
    } else {
        $message = "Erreur lors de la suppression du film : " . $conn->error;
    }

    $stmt->close();
}

$sql = "SELECT id, title FROM films";
$result = $conn->query($sql);

$films = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $films[] = $row;
    }
}

$conn->close();

session_start();
$_SESSION['message'] = isset($message) ? $message : '';
$_SESSION['films'] = $films;

// Rediriger vers la page HTML
header('Location: delete_film.html');
exit();
?>
