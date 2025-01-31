<?php
$bdd = new PDO('mysql:host=localhost;dbname=webcinema;charset=utf8', 'root', '');

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
            echo "Erreur lors de l'upload de l'image.";
            exit;
        }
    } else {
        $sql = "SELECT image_url FROM films WHERE id = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$film_id]);
        $film = $stmt->fetch();
        $image_url = $film['image_url'];
    }

    $sql = "UPDATE films SET title = ?, description = ?, image_url = ? WHERE id = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$title, $description, $image_url, $film_id]);

    if ($stmt->rowCount() > 0) {
        echo "Film mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du film.";
    }
}
?>

