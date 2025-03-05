<?php

class Film
{
    private $idSalle;
    private $nomSalle;
    private $nb_place;

    /**
     * @return mixed
     */
    public function getNbPlace()
    {
        return $this->nb_place;
    }

    /**
     * @param mixed $nb_place
     */
    public function setNbPlace($nb_place)
    {
        $this->nb_place = $nb_place;
    }

    /**
     * @return mixed
     */
    public function getNomSalle()
    {
        return $this->nomSalle;
    }

    /**
     * @param mixed $nomSalle
     */
    public function setNomSalle($nomSalle)
    {
        $this->nomSalle = $nomSalle;
    }

    /**
     * @return mixed
     */
    public function getIdSalle()
    {
        return $this->idSalle;
    }

    /**
     * @param mixed $idSalle
     */
    public function setIdSalle($idSalle)
    {
        $this->idSalle = $idSalle;
    }


}