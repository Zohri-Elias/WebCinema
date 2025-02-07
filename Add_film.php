<?php
require_once "../src/bdd/Bdd.php";
require_once "../src/modele/Film.php";
require_once "../src/repository/FilmRepository.php";

$bdd = new PDO('mysql:host=localhost;dbname=webcinema;charset=utf8', 'root', '');

$req = $bdd->prepare('INSERT INTO film (nom_film, duree, genre, description, image) VALUES(:nom_film, :duree, :genre, :description, :image)');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_film = $_POST['nom_film'];
    $duree = $_POST['duree'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $image = $_POST['image'];


    if ($image) {
        $image = basename($image);
        $image_stock = "uploads/" . $image;
        $image_data = file_get_contents($image);

        if ($image_data !== false) {
            file_put_contents($image_stock, $image_data);

            echo "Image téléchargée avec succès et enregistrée sous : $image_stock";
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    } else {
        echo "URL invalide.";
        $ajouterFilm = new ajouterFilm();

        if (move_uploaded_file($image, $image_stock)) {
            $films = $ajouterFilm->ajoutFilm();

            echo "Film ajouté avec succès!";
        } else {
            echo "Erreur lors de l'upload de l'image.";
        }
    }
}
else {
        echo "Aucune image téléchargée.";
    }
}
?>
