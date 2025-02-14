<?php
require_once '../../src/bdd/Bdd.php';
require_once '../../src/repository/UtilisateurRepository.php';

$database = new Bdd();
$bdd = $database->getBdd();

if(isset($_POST['ok'])){
    extract($_POST);
    var_dump($_POST);

$req = $bdd ->prepare("INSERT INTO utilisateur (nom , prenom,email,mdp) VALUES ( :nom, :prenom, :email, MD5(:mdp))");
$req ->execute(array(
    "nom" => $nom,
    "prenom" => $prenom,
    "email" => $email,
    "mdp" => $mdp,


));
$reponse = $req ->fetchAll(PDO::FETCH_ASSOC);
var_dump($reponse);
}

?>
