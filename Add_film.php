<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webcinema";
$bdd = new PDO('mysql:host=localhost;dbname=webcinema;charset=utf8', 'root', '');
$req = $bdd->prepare('INSERT INTO film (nom_film, duree, genre, description, image) VALUES(:nom_film, :duree, :genre, :description, :image)');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_film = $_POST['film-title'];
    $description = $_POST['film-description'];

    $image = $_FILES['film-image']['name'];
    $image_tmp = $_FILES['film-image']['tmp_name'];
    $image_path = "uploads/" . basename($image);

    if (move_uploaded_file($image_tmp, $image_path)) {
        $sql = "INSERT INTO film (nom_film, description, image_url) VALUES ('$nom_film', '$description', '$image_path')";

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
