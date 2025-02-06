<?php
class Utilisateur
{
    private $idUtilisateur;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $role;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                // On appelle le setter
                $this->$method($value);
            }
        }
    }
    $utilisateur = new Utilisateur(
}



