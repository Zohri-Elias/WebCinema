<?php

class Inscription
{
    private $nom;

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

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    private $prenom;

    private $email;
    private $mdp;

    public function __construct($nom, $prenom, $email, $mdp)
    {
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setEmail($email);
        $this->setMdp($mdp);

    }



    public function inscrire()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Webcinema', 'root', '');
        $req = $bdd->prepare('INSERT INTO utilisateur (nom , prenom , email , mdp) VALUES (:prenom, :nom, :email , :mdp)');
        $req->execute(array(
            'nom' => $this->getNom(),
            'prenom' => $this->getPrenom(),
            'email' => $this->getEmail(),
            'mdp' => $this->getMdp()

        ));
    }
}



