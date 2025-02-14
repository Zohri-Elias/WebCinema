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
}
?>
