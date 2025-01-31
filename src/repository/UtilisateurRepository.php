<?php
require_once __dir__ . "../model/Utilisateur.php";
require_once __dir__ . "../../trt1_Ins.php";


public function Inscription($connection)
{
    $req = $connection->prepare('INSERT INTO utilisateur (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :mdp)');
    $req->execute([
        'nom' => $this->nom,
        'prenom' => $this->prenom,
        'email' => $this->email,
        'mdp' => $this->mdp,
    ]);
}



public function Connexion($connection)
{
    $req = $connection->prepare('SELECT * FROM utilisateur WHERE email = :email');
    $req->execute(['email' => $this->getEmail(), 'mdp' => $this->getMdp()]);
));

    $result = $req->fetch();
    return $result !== false;




}

?>