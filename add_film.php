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
    $title = $_POST['film-title'];
    $description = $_POST['film-description'];

    $image = $_FILES['film-image']['name'];
    $image_tmp = $_FILES['film-image']['tmp_name'];
    $image_path = "uploads/" . basename($image);

    if (move_uploaded_file($image_tmp, $image_path)) {
        $sql = "INSERT INTO films (title, description, image_url) VALUES ('$title', '$description', '$image_path')";

        if ($conn->query($sql) === TRUE) {
            echo "Film ajouté avec succès.";
        } else {
            echo "Erreur : " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Erreur lors de l'upload de l'image.";
    }
}

$conn->close();
?>
