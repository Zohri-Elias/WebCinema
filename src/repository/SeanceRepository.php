<?php
class SeanceRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new Bdd();
    }

    public function ajoutSeance(Sceance $seance)
    {
        $sql = "INSERT INTO Livre(date,heure,nb_place_res,ref_salle,ref_film) 
                VALUES (:date,:heure,:nb_place_res,:ref_salle,:ref_film)";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'date'  => $seance->getDate(),
            'heure' => $seance->getHeure(),
            'nb_place_res' => $seance->getNbPlaceRes(),
            'ref_salle' => $seance->getRefSalle(),
            'ref_film' => $seance->getRefFilm()
        ));

        if ($res == true) {
            return true;
        } else {
            return false;
        }
    }

    public function modifSeance(Seance $seance)
    {
        $sql = "UPDATE Seance SET date=:date,heure=:heure,nb_place_res=:nb_place_res,ref_salle=:ref_salle,ref_film=:ref_film";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'date' => $seance->getTitre(),
            'heure' => $seance->getHeure(),
            'email' => $seance->getEmail(),
            'nb_place_res' => $seance->getNbPlaceRes(),
            'ref_salle' => $seance->getRefSalle(),
            'ref_film' => $seance->getRefFilm()
        ));
        if ($res == true) {
            return true;
        } else {
            return false;
        }

    }


    public function suppressionSeance(Sceance $seance)
    {
        $sql = "DELETE FROM Seance WHERE idSeance = :idSeance";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'idSeance' => $seance->getIdSceance()
        ));
        if ($res == true) {
            return true;
        } else {
            return false;
        }
    }
}