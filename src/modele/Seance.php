<?php
class Seance
{
    private $id_seance;
    private $date;
    private $heure;
    private $nb_place_res;
    private $ref_salle;
    private $ref_film;

    // Constructeur acceptant un tableau avec les propriétés
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    // Hydratation de l'objet à partir du tableau
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key); // Génération du nom de la méthode
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Getters et setters
    public function getId_seance()
    {
        return $this->id_seance;
    }

    public function setId_seance($id_seance)
    {
        $this->id_seance = $id_seance;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getHeure()
    {
        return $this->heure;
    }

    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    public function getNb_place_res()
    {
        return $this->nb_place_res;
    }

    public function setNb_place_res($nb_place_res)
    {
        $this->nb_place_res = $nb_place_res;
    }

    public function getRef_salle()
    {
        return $this->ref_salle;
    }

    public function setRef_salle($ref_salle)
    {
        $this->ref_salle = $ref_salle;
    }

    public function getRef_film()
    {
        return $this->ref_film;
    }

    public function setRef_film($ref_film)
    {
        $this->ref_film = $ref_film;
    }
}
?>
