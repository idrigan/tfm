<?php

namespace Component\Domain\Entity;

/**
 * MusicalTaste
 */
class MusicalTaste
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * MusicalTaste constructor.
     * @param int $id
     * @param string $name
     * @param string $description
     */
    public function __construct($id = '', $name = '', $description = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return MusicalTaste
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return MusicalTaste
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    public function __toString()
    {
        return $this->getName();
    }
}

