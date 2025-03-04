
<?php
class UtilisateurRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new Bdd();
    }

    public function inscription(Utilisateur $utilisateur)
    {
        $hashedPassword = password_hash($utilisateur->getMdp(), PASSWORD_DEFAULT);

        $req = $this->bdd->getBdd()->prepare('INSERT INTO utilisateur (prenom, nom, email, mdp) VALUES (:prenom, :nom, :email, :mdp)');
        $success = $req->execute([
            "nom" => $utilisateur->getNom(),
            "prenom" => $utilisateur->getPrenom(),
            "email" => $utilisateur->getEmail(),
            "mdp" => $hashedPassword
        ]);

        return $success;
    }

    public function connexion($email, $mdp)
    {
        $req = $this->bdd->getBdd()->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $req->execute(['email' => $email]);

        $utilisateur = $req->fetch(PDO::FETCH_ASSOC);
        var_dump($utilisateur);
        var_dump(password_verify($mdp, $utilisateur['mdp']));
        if ($utilisateur && password_verify($mdp, $utilisateur['mdp'])) {
            return $utilisateur;
        }

        return false;
    }

    public function getUtilisateur($email) {
        $query = "SELECT * FROM utilisateur WHERE email = :email";
        $stmt = $this->bdd->getBdd()->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            return new Utilisateur($userData);
        }
        return null;
    }

    public function modifierUtilisateur(Utilisateur $utilisateur) {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("ID utilisateur non défini dans la session.");
        }

        $hashedPassword = password_hash($utilisateur->getMdp(), PASSWORD_DEFAULT);

        $req = $this->bdd->getBdd()->prepare('
        UPDATE utilisateur 
        SET prenom = :prenom, nom = :nom, email = :email, mdp = :mdp 
        WHERE id = :id;
    ');

        $success = $req->execute([
            "id" => $_SESSION['user_id'],
            "nom" => $utilisateur->getNom(),
            "prenom" => $utilisateur->getPrenom(),
            "email" => $utilisateur->getEmail(),
            "mdp" => $hashedPassword,
            "role"=> $utilisateur->getRole()
        ]);

        return $success;
    }


}
?>
