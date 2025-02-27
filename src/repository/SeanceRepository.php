<?php
class SeanceRepository
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new Bdd();
    }

    public function ajouterSeance(Seance $seance)
    {

        $req = $this->bdd->getBdd()->prepare('
        INSERT INTO seance (date, heure, nb_place_res, ref_salle, ref_film) 
        VALUES (:date, :heure, :nb_place_res, :ref_salle, :ref_film)');


        $success = $req->execute([
            "date" => $seance->getDate(),
            "heure" => $seance->getHeure(),
            "nb_place_res" => $seance->getNbPlaceRes(),
            "ref_salle" => $seance->getRefSalle(),
            "ref_film" => $seance->getRefFilm()
        ]);


        return $success;
    }



    public function modifSeance(Seance $seance)
    {
        $sql = "UPDATE Seance SET date=:date,heure=:heure,nb_place_res=:nb_place_res,ref_salle=:ref_salle,ref_film=:ref_film";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'date' => $seance->getTitre(),
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


    public function suppressionSeance(Seance $seance)
    {
        $sql = "DELETE * FROM Seance WHERE id_Seance = :id_Seance";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'id_seance' => $seance->getId_seance()
        ));
        if ($res == true) {
            return true;
        } else {
            return false;
        }
    }
}