<?php

$bdd = new PDO('mysql:host=localhost;dbname=webcinema;charset=utf8', 'root', '');

$req = $bdd->prepare('INSERT INTO film (nom_film, duree, genre, description, image) VALUES(:nom_film, :duree, :genre, :description, :image)');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_film = $_POST['film-title'];
    $duree = $_POST['film-duration'];
    $genre = $_POST['film-genre'];
    $description = $_POST['film-description'];

    if ($_FILES['film-image']['error'] == 0) {
        $image = $_FILES['film-image']['name'];
        $image_tmp = $_FILES['film-image']['tmp_name'];
        $image_path = "uploads/" . basename($image);

        if (move_uploaded_file($image_tmp, $image_path)) {
            $req->execute([
                'nom_film' => $nom_film,
                'duree' => $duree,
                'genre' => $genre,
                'description' => $description,
                'image' => $image_path
            ]);

            echo "Film ajouté avec succès!";
        } else {
            echo "Erreur lors de l'upload de l'image.";
        }
    } else {
        echo "Aucune image téléchargée.";
    }
}

?>
