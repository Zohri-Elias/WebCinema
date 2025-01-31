<?php


class Sceance
{
 private $idSceance;
 private $date;
 private $heure;
private $email;
private $nbPlaceRes;
private $refPlace;
private $refFilm;
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }
    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                // On appelle le setter
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getIdSceance()
    {
        return $this->idSceance;
    }

    /**
     * @param mixed $idSceance
     */
    public function setIdSceance($idSceance)
    {
        $this->idSceance = $idSceance;
    }

    /**
     * @return mixed
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param mixed $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getNbPlaceRes()
    {
        return $this->nbPlaceRes;
    }

    /**
     * @param mixed $nbPlaceRes
     */
    public function setNbPlaceRes($nbPlaceRes)
    {
        $this->nbPlaceRes = $nbPlaceRes;
    }

    /**
     * @return mixed
     */
    public function getRefPlace()
    {
        return $this->refPlace;
    }

    /**
     * @param mixed $refPlace
     */
    public function setRefPlace($refPlace)
    {
        $this->refPlace = $refPlace;
    }

    /**
     * @return mixed
     */
    public function getRefFilm()
    {
        return $this->refFilm;
    }

    /**
     * @param mixed $refFilm
     */
    public function setRefFilm($refFilm)
    {
        $this->refFilm = $refFilm;
    }

}