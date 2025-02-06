<?php

class FilmRepository
{
    private $bdd;
    private $reservation;
    public function __construct()
    {
        $this->bdd = new PDO('mysql:host=localhost;dbname=films', 'root', '');
    }

    public function reservation(FilmRepository $reservation)
    {

        $sql = "INSERT INTO reservation (nbr_place,ref_seance,ref_user) 
                VALUES (:nbr_place,:ref_seance,:ref_user)";
        $req = $this->bdd->getBdd()->prepare($sql);
        $resu = $req->execute(array(
            'nombre_place' => $reservation->getNbrPlace(),
            'scence' => $reservation->getRef_seance(),
            'user' => $reservation->getRef_User(),
        ));

        if ($resu == true) {
            return true;
        } else {
            return false;
        }

    }
}