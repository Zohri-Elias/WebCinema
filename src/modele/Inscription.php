<?php
namespace src\modele;

require_once 'src/bdd/BDD.php';

use Bdd;
use PDO;

class Inscription {
    private $nom;
    private $prenom;
    private $email;
    private $mdp;

    public function __construct($nom, $prenom, $email, $mdp) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
    }

    public function inscrire() {
        $bdd = new Bdd();
        $connection = $bdd->getbdd();


        $hashedPassword = password_hash($this->mdp, PASSWORD_DEFAULT);
        $req = $connection->prepare('INSERT INTO utilisateur (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :mdp)');
        $req->execute([
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'mdp' => $hashedPassword
        ]);
    }
}
?>
