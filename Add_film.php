<?php
require_once "./src/modele/Film.php";
require_once "./src/repository/FilmRepository.php";

$bdd = new PDO('mysql:host=localhost;dbname=webcinema;=utfcharset8', 'root', '');

$req = $bdd->prepare('INSERT INTO film (nom_film, genre, description, image) VALUES(:nom_film, :genre, :description, :image)');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_film = $_POST['nom_film'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $image = $_POST['image'];



    if ($image) {
        $image_data = file_get_contents($image);

        if ($image_data !== false) {
            $image_name = basename($image);
            $image_stock = "assets/img/" . $image_name;
            file_put_contents($image_stock, $image_data);

            echo "Image téléchargée avec succès et enregistrée sous : $image_stock <br>";
            try {
                $req->execute(array(
                    'nom_film' => $_POST['nom_film'],
                    'genre' => $_POST['genre'],
                    'description' => $_POST['description'],
                    'image' => $_POST['image']
                ));
            }catch (Exception $e){
                var_dump($e);
            }

            exit();
        } else {
            echo "Erreur lors du téléchargement de l'image depuis l'URL.";
        }
    }
    else {
        echo "URL invalide.";

        if (move_uploaded_file($image)) {
            echo "Film ajouté avec succès!";

        } else {
            echo "Erreur lors de l'upload de l'image.";
        }
    }
}
else {
        echo "Aucune image téléchargée.";
        exit();
    }

?>
