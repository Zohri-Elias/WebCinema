<?php

require_once '../../src/bdd/Bdd.php';
require_once '../../src/modele/Seance.php';
require_once '../../src/repository/SeanceRepository.php';


if (isset($_POST['ok'])) {

    $id_seance = $_POST['id_seance'];


    $date = isset($_POST['date']) ? $_POST['date'] : null;
    $heure = isset($_POST['heure']) ? $_POST['heure'] : null;
    $nb_place_res = isset($_POST['nb_place_res']) ? $_POST['nb_place_res'] : null;
    $ref_salle = isset($_POST['ref_salle']) ? $_POST['ref_salle'] : null;
    $ref_film = isset($_POST['ref_film']) ? $_POST['ref_film'] : null;


    $seanceRepo = new SeanceRepository();

    $result = $seanceRepo->modifierSeance($id_seance, $date, $heure, $nb_place_res, $ref_salle, $ref_film);

    echo $result;
}
?>
