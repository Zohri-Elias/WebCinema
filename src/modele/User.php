<?php
class User {
    private $nom;
    private $prenom;
    private $email;
    private $password;
    public function __construct($nom, $prenom, $email, $password) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
    }
}