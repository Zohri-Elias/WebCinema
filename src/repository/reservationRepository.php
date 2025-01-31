<?php
class reservationRepository{

public function ConfirmReservation(Reservation $reservation){
    $sql = "INSERT INTO Reservation(ref_user,ref_seance,nbr_place) 
                VALUES (:ref_user,:ref_seance,:nbr_place)";
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
public function suppressionSeance(Reservation $reservation)
{
    $sql = "DELETE * FROM Reservation WHERE id_reservation = :id_reservation";
    $req = $this->bdd->getBdd()->prepare($sql);
    $res = $req->execute(array(
        'id_reservation' => $reservation->getId_reservation()
    ));
    if ($res == true) {
        return true;
    } else {
        return false;
    }
}
}