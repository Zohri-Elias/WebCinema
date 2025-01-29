<?php

namespace src\modele;

class Connexion
{
    private $email;
    private $mdp;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * @param mixed $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    public function __construct($email, $mdp)
    {
        $this->setEmail($email);
        $this->setMdp($mdp);
    }

    public function verifierConnexion()
    {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=webcinema', 'root', '');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $req = $bdd->prepare('SELECT * FROM utilisateur WHERE email = :email AND mdp = :mdp');
            $req->execute(array(
                'email' => $this->getEmail(),
                'mdp' => $this->getMdp(),
            ));

            $result = $req->fetch();
            return $result !== false; // Retourne `true` si l'utilisateur existe, sinon `false`.
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}

?>
