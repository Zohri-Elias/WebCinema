<?php

class SalleRepository
{
    private $bdd;
    private $film;
    public function __construct()
    {
        $this->bdd = new PDO('mysql:host=localhost;dbname=webcinema', 'root', '');
    }
    public function ajouterSalle(Salle $salle)
    {
        $sql = "INSERT INTO salle (nom_salle, nb_place) 
            VALUES (:nom_salle, :nb_salle)";

        $req = $this->bdd->prepare($sql);

        $result = $req->execute(array(
            'nom_salle' => $salle->getNomSalle(),
            'nb_place' => $salle->getNbSPlace(),
        ));

        if ($result) {
            return true;
        } else {
            return false;
        }


    }

    public function supprimerSalle($idSalle)
    {
        $sql = "DELETE FROM film WHERE id_Salle = :id_salle";

        $req = $this->bdd->prepare($sql);

        $result = $req->execute(array(
            'id_salle' => $idSalle
        ));

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function modifierSalle(Salle $salle)
    {
        $sql = "UPDATE salle 
                SET nom_salle = :nom_salle, nb_place = :nb_place)
                WHERE id_salle = :id_salle";

        $req = $this->bdd->prepare($sql);
        $req->execute([
            'id_salle' => $salle->getIdSalle(),
            'nom_salle' => $salle->getNomSalle(),
            'nb_salle' => $salle->getNbSalle(),
        ]);

        return $req->rowCount() > 0;
    }
}
// port=3307;
?>