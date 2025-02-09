<?php
require_once '../bdd/Bdd.php';
require_once '../modele/Utilisateur.php';
class UtilisateurRepository {
    private $bdd;

    public function __construct(Bdd $bdd) {
        $this->bdd = $bdd->getbdd();
    }

    public function inscription(Utilisateur $utilisateur) {
        $query = "INSERT INTO utilisateurs (nom, prenom, email, mdp, role) VALUES (:nom, :prenom, :email, :mdp, :role)";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindValue(':nom', $utilisateur->getNom());
        $stmt->bindValue(':prenom', $utilisateur->getPrenom());
        $stmt->bindValue(':email', $utilisateur->getEmail());
        $stmt->bindValue(':mdp', $utilisateur->getMdp());
        $stmt->bindValue(':role', $utilisateur->getRole());
        return $stmt->execute();
    }

    public function connexion($email, $mdp) {
        $query = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData && password_verify($mdp, $userData['mdp'])) {
            $utilisateur = new Utilisateur($userData);
            return $utilisateur;
        } else {
            return null;
        }
    }
}
?>
