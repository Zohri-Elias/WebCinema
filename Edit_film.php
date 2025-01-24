<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $film_id = $_POST['film-id'];
    $title = $_POST['film-title'];
    $description = $_POST['film-description'];

    if ($_FILES['film-image']['error'] == 0) {
        $image = $_FILES['film-image']['name'];
        $image_tmp = $_FILES['film-image']['tmp_name'];
        $image_path = "uploads/" . basename($image);

        if (move_uploaded_file($image_tmp, $image_path)) {
            $image_url = $image_path;
        } else {
            $image_url = null;
        }
    } else {
        $sql = "SELECT image_url FROM films WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $film_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $film = $result->fetch_assoc();
        $image_url = $film['image_url'];
    }

    $sql = "UPDATE films SET title = ?, description = ?, image_url = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $description, $image_url, $film_id);

    if ($stmt->execute()) {
        echo "Film mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du film : " . $conn->error;
    }
}

$conn->close();
?>
