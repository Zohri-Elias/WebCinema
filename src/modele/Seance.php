<?php

class Seance
{
    private $id_seance;
    private $date;
    private $heure;
    private $nb_place_res;
    private $ref_salle;
    private $ref_film;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
                var_dump($key, $value); // Vérifier les données
            }
        }
    }


    public function getIdSeance()
    {
        return $this->id_seance;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getHeure()
    {
        return $this->heure;
    }

    public function getNbPlaceRes()
    {
        return $this->nb_place_res;
    }

    public function getRefSalle()
    {
        return $this->ref_salle;
    }

    public function getRefFilm()
    {
        return $this->ref_film;
    }
    /**
     * @param mixed $ref_film
     */
    public function setRefFilm($ref_film)
    {
        $this->ref_film = $ref_film;
    }

    /**
     * @param mixed $ref_salle
     */
    public function setRefSalle($ref_salle)
    {
        $this->ref_salle = (int)$ref_salle;
    }

    /**
     * @param mixed $nb_place_res
     */
    public function setNbPlaceRes($nb_place_res)
    {
        $this->nb_place_res = (int)$nb_place_res;
    }

    /**
     * @param mixed $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $id_seance
     */
    public function setIdSeance($id_seance)
    {
        $this->id_seance = (int)$id_seance;
    }


}
