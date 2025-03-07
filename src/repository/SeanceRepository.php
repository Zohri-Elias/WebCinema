<?php
class SeanceRepository
{
    private $pdo;

    public function __construct()
    {
        $database = new Bdd();
        $this->pdo = $database->getBdd();
    }

    // Ajouter une séance dans la base de données
    public function ajouterSeance(Seance $seance)
    {
        try {
            $sql = "INSERT INTO seances (date_seance, heure, ref_film, ref_salle, nb_place_res) 
                    VALUES (:date_seance, :heure, :ref_film, :ref_salle, :nb_place_res)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':date_seance', $seance->getDate());
            $stmt->bindParam(':heure', $seance->getHeure());
            $stmt->bindParam(':ref_film', $seance->getRef_film());
            $stmt->bindParam(':ref_salle', $seance->getRef_salle());
            $stmt->bindParam(':nb_place_res', $seance->getNb_place_res());

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la séance: " . $e->getMessage();
            return false;
        }
    }
}
?>
