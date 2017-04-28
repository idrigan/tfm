<?php


namespace Component\Domain\Entity;

/**
 *  @ORM\Entity(repositoryClass="AppBundle\Repository\Publication\MusicalTasteRepositoryImpl")
 *  @ORM\Table(name="musical_taste")
 */
class MusicalTaste
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    private $name;
}