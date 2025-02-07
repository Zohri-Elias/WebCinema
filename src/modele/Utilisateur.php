<?php
class Utilisateur {
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $role;

    public function __construct(array $data = []) {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Getters
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getEmail() { return $this->email; }
    public function getMdp() { return $this->mdp; }
    public function getRole() { return $this->role; }

    // Setters
    public function setNom($nom) { $this->nom = $nom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }
    public function setEmail($email) { $this->email = $email; }
    public function setMdp($mdp) { $this->mdp = password_hash($mdp, PASSWORD_BCRYPT); }
    public function setRole($role) { $this->role = $role; }
}
?>
