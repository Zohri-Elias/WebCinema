
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

    public function modifierUtilisateur($prenom, $nom, $email, $idUtilisateur) {
        // Créer un tableau pour stocker les champs à mettre à jour et leurs valeurs
        $updateFields = [];
        $params = [];

        // Ajouter les champs modifiés à la requête
        if ($prenom) {
            $updateFields[] = "prenom = :prenom";
            $params['prenom'] = $prenom;
        }

        if ($nom) {
            $updateFields[] = "nom = :nom";
            $params['nom'] = $nom;
        }

        if ($email) {
            $updateFields[] = "email = :email";
            $params['email'] = $email;
        }

        // Si aucune donnée n'est remplie, on arrête le processus
        if (empty($updateFields)) {
            return false;
        }

        // Ajouter l'ID utilisateur à la requête
        $updateFields[] = "id_utilisateur = :id_utilisateur";
        $params['id_utilisateur'] = $idUtilisateur;

        // Construire la requête SQL
        $query = "UPDATE utilisateur SET " . implode(", ", $updateFields) . " WHERE id_utilisateur = :id_utilisateur";

        // Préparer la requête
        $stmt = $this->bdd->prepare($query);


        return $stmt->execute($params);
    }
}

?>


