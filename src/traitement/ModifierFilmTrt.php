<?php


require_once '../../src/bdd/Bdd.php';
$database = new Bdd();
$bdd = $database->getBdd();


if (isset($_POST['ok'])) {
    extract($_POST);


    $sql = "UPDATE film 
            SET nom_film = :nom_film, genre = :genre, description = :description, duree = :duree 
            WHERE id_film = :id_film";

    $stmt = $bdd->prepare($sql);


    $stmt->execute([
        'id_film' => $id_film,
        'nom_film' => $nom_film,
        'genre' => $genre,
        'description' => $description,
        'duree' => $duree
    ]);


    if ($stmt->rowCount() > 0) {
        echo "Modification réussie!";
        header('Location: ../../vue/Catalogue.php');
        exit();
    } else {
        echo "Aucune modification effectuée. Assurez-vous que l'ID du film est correct.";
    }
}
?>
