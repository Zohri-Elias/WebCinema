<?php

class SalleRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new PDO('mysql:host=localhost;dbname=webcinema', 'root', '');
    }

    public function ajouterSalle(Salle $salle)
    {
        $sql = "INSERT INTO salle (nom_salle, nb_place) VALUES (:nom_salle, :nb_place)";
        $req = $this->bdd->prepare($sql);

        $result = $req->execute(array(
            'nom_salle' => $salle->getNomSalle(),
            'nb_place' => $salle->getNbPlace(),
        ));

        return $result;
    }

    public function supprimerSalle($idSalle)
    {
        // Assurez-vous de supprimer d'abord toutes les dépendances, ici la table 'film'
        $sql = "DELETE FROM salle WHERE id_salle = :id_salle";
        $req = $this->bdd->prepare($sql);
        $result = $req->execute(array(
            'id_salle' => $idSalle
        ));

        return $result;
    }

    public function modifierSalle(Salle $salle)
    {
        $sql = "UPDATE salle SET nom_salle = :nom_salle, nb_place = :nb_place WHERE id_salle = :id_salle";
        $req = $this->bdd->prepare($sql);
        $req->execute([
            'id_salle' => $salle->getIdSalle(),
            'nom_salle' => $salle->getNomSalle(),
            'nb_place' => $salle->getNbPlace(),
        ]);

        return $req->rowCount() > 0;
    }
}
?>
