<?php

class Salle
{
    private $idSalle;
    private $nomSalle;
    private $nbPlace;

    public function __construct($idSalle = null, $nomSalle, $nbPlace)
    {
        $this->idSalle = $idSalle;
        $this->nomSalle = $nomSalle;
        $this->nbPlace = $nbPlace;
    }

    public function getNbPlace()
    {
        return $this->nbPlace;
    }

    public function setNbPlace($nbPlace)
    {
        $this->nbPlace = $nbPlace;
    }

    public function getNomSalle()
    {
        return $this->nomSalle;
    }

    public function setNomSalle($nomSalle)
    {
        $this->nomSalle = $nomSalle;
    }

    public function getIdSalle()
    {
        return $this->idSalle;
    }

    public function setIdSalle($idSalle)
    {
        $this->idSalle = $idSalle;
    }
}
?>
