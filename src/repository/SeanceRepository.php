<?php
class SeanceRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new Bdd();
    }

    public function ajoutSeance(Sceance $sceance)
    {
        $sql = "INSERT INTO Livre(date,heure,nb_place_res,ref_salle,ref_film) 
                VALUES (:date,:heure,:nb_place_res,:ref_salle,:ref_film)";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'date'  => $sceance->getDate(),
            'heure' => $sceance->getHeure(),
            'nb_place_res' => $sceance->getNbPlaceRes(),
            'ref_salle' => $sceance->getRefSalle(),
            'ref_film' => $sceance->getRefFilm()
        ));

        if ($res == true) {
            return true;
        } else {
            return false;
        }
    }

    public function modifSceance(Sceance $sceance)
    {
        $sql = "UPDATE Sceance SET 
                   date=:date,
                   heure=:heure,
                   nb_place_res=:nb_place_res,
                   ref_salle=:ref_salle,
                   ref_film=:ref_film";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'date' => $livre->getTitre(),
            'heure' => $livre->getHeure(),
            'email' => $livre->getEmail(),
            'nb_place_res' => $livre->getNbPlaceRes(),
            'ref_salle' => $livre->getRefSalle(),
            'ref_film' => $livre->getRefFilm()
        ));
        if ($res == true) {
            return true;
        } else {
            return false;
        }

    }


    public function suppressionSceance(Sceance $sceance)
    {
        $sql = "DELETE FROM Sceance WHERE idSceance = :idSceance";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'idSceance' => $sceance->getIdSceance()
        ));
        if ($res == true) {
            return true;
        } else {
            return false;
        }
    }
}