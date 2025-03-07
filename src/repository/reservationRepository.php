<?php
class reservationRepository{

public function ConfirmReservation(Reservation $reservation){
    $sql = "SELECT ref_user,ref_seance,nbr_place FROM Reservation WHERE id_reservation = :id_reservation";
    $req = $this->bdd->getBdd()->prepare($sql);
    $res = $req->execute(array(
        'ref_user' => $reservation->getRef_user(),
        'ref_seance' => $reservation->getRef_seance(),
        'nbr_place' => $reservation->getNbr_place(),
    ));

    if ($res == true) {
        return true;
    } else {
        return false;
    }
}
    public function Reservation(Film $film){
        $sql = "SELECT id_film,nom_film,duree,image,genre,descriptions FROM film WHERE id_film = :id_film";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(
            'id_film' => $film->getIdFilm(),
            'nom_film' => $film->getNomFilm(),
            'duree' => $film->getDuree(),
            'image' => $film->getImage(),
            'genre' => $film->getGenre(),
            'descriptions' => $film->getDescription()
        ));

        if ($res == true) {
            return true;
        } else {
            return false;
        }
    }
}