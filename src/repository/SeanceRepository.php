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



    public function modifierSeance($id_seance, $date, $heure, $nb_place_res, $ref_salle, $ref_film) {
        try {

            $updateFields = [];
            $params = [];


            if ($date !== null) {
                $updateFields[] = "date = :date";
                $params[':date'] = $date;
            }

            if ($heure !== null) {
                $updateFields[] = "heure = :heure";
                $params[':heure'] = $heure;
            }

            if ($nb_place_res !== null) {
                $updateFields[] = "nb_place_res = :nb_place_res";
                $params[':nb_place_res'] = $nb_place_res;
            }

            if ($ref_salle !== null) {
                $updateFields[] = "ref_salle = :ref_salle";
                $params[':ref_salle'] = $ref_salle;
            }

            if ($ref_film !== null) {
                $updateFields[] = "ref_film = :ref_film";
                $params[':ref_film'] = $ref_film;
            }


            if (empty($updateFields)) {
                throw new Exception("Aucune donnée n'a été modifiée.");
            }


            $sql = "UPDATE seance SET " . implode(", ", $updateFields) . " WHERE id_seance = :id_seance";
            $params[':id_seance'] = $id_seance;


            $stmt = $this->bdd->getBdd()->prepare($sql);
            $stmt->execute($params);

            return "La séance a été modifiée avec succès.";
        } catch (Exception $e) {

            return "Erreur lors de la modification de la séance : " . $e->getMessage();
        }
    }





    public function supprimerSeance($id_Seance)
    {
        $sql = "DELETE FROM Seance WHERE id_Seance = :id_Seance";
        $req = $this->bdd->getBdd()->prepare($sql);
        $res = $req->execute(array(':id_Seance' => $id_Seance));

        if ($res) {
            return true;
        } else {
            return false;
        }
    }


}