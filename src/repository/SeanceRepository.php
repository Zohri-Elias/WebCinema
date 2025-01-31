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
        $sql = "INSERT INTO Livre(date,heure,email,nb_place_res,ref_salle,ref_film) 
                VALUES (:date,:heure,:email,:nb_place_res,:ref_salle,:ref_film)";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'date' => $sceance->getDate(),
            'heure' => $sceance->getHeure(),
            'email' => $sceance->getEmail(),
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
        $sql = "INSERT INTO Livre(titre,annee,resume) 
                VALUES (:titre,:annee,:resume)";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'titre' => $livre->getTitre(),
            'annee' => $livre->getAnnee(),
            'resume' => $livre->getResume(),
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