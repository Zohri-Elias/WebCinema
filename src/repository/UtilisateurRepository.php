<?php
class UtilisateurRepository {
private $bdd;

public function __construct(Bdd $bdd) {
$this->bdd = $bdd->getbdd();
}

public function Inscription(Utilisateur $user) {
$req = $this->bdd->prepare("INSERT INTO utilisateur (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :mdp)");
return $req->execute([
'nom' => $user->getNom(),
'prenom' => $user->getPrenom(),
'email' => $user->getEmail(),
'mdp' => password_hash($user->getMdp(), PASSWORD_BCRYPT)
]);
}

public function connexion($email, $mdp) {
$req = $this->bdd->prepare("SELECT * FROM utilisateur WHERE email = :email");
$req->execute(['email' => $email]);
$user = $req->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($mdp, $user['mdp'])) {
return new Utilisateur($user['nom'], $user['prenom'], $user['email'], $user['mdp'], $user['id']);
}
return null;
}
}