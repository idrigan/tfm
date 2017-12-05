<?php

namespace Component\Domain\DTO;


use Component\Domain\Entity\MusicalTaste;

class MusicalTasteDTO
{
    private $musicalTaste;
    private $checked;

    /**
     * MusicalTasteDTO constructor.
     * @param $musicalTaste
     * @param $checked
     */
    public function __construct(MusicalTaste $musicalTaste, $checked ='')
    {
        $this->musicalTaste = $musicalTaste;
        $this->checked = $checked;
    }

    /**
     * @return mixed
     */
    public function getMusicalTaste():MusicalTaste
    {
        return $this->musicalTaste;
    }

    /**
     * @param mixed $musicalTaste
     */
    public function setMusicalTaste($musicalTaste)
    {
        $this->musicalTaste = $musicalTaste;
    }

    /**
     * @return mixed
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * @param mixed $checked
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;
    }


}