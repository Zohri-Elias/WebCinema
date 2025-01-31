<?php
class UtilisateurRepository
{
    public function inscription($connection)
    {
        $req = $connection->prepare('INSERT INTO utilisateur (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :mdp)');
        $req->execute([
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'mdp' => $this->mdp,
        ]);
    }

    public function connexion($connection)
    {
        $req = $connection->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $req->execute(['email' => $this->getEmail(), 'mdp' => $this->getMdp()]);

        $result = $req->fetch();
        return $result !== false;
    }
}
?>