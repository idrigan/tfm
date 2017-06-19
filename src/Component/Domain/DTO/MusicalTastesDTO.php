<?php


namespace Component\Domain\DTO;


use Component\Domain\Entity\MusicalTaste;
use Component\Domain\Entity\User;

class MusicalTastesDTO
{
    private $musicalTastes;
    private $idUser;

    /**
     * MusicalTastesDTO constructor.
     * @param $idUser
     * @param $musicalTastes
     */
    public function __construct( $idUser='', $musicalTastes = array())
    {
        $this->musicalTastes = $musicalTastes;
        $this->idUser = $idUser;
    }

    public function setId($idUser){
        $this->idUser = $idUser;
    }

    public function getId(){
        return $this->idUser;
    }

    /**
     * @return mixed
     */
    public function getMusicalTastes()
    {
        return $this->musicalTastes;
    }

    /**
     * @param mixed $musicalTastes
     */
    public function setMusicalTastes($musicalTastes)
    {
        $this->musicalTastes = $musicalTastes;
    }

    public function addMusicalTaste(MusicalTasteDTO $musicalTaste){
        $this->musicalTastes[] = $musicalTaste;
    }


}