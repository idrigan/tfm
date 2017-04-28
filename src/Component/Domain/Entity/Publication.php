<?php

namespace Component\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity(repositoryClass="AppBundle\Repository\Publication\PublicationRepositoryImpl")
 *  @ORM\Table(name="publication")
 */
class Publication
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $idUser;

    /**
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;


    /**
     * @ORM\Column(type="datetime")
     */
    private $date_create;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_update;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_remove;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    public function __construct($title,$content,$date_create,$active)
    {
        $this->title = $title;
        $this->content = $content;
        $this->date_create = $date_create;
        $this->active = $active;
    }

    public function setDateUpdate($date_update){
        $this->date_update = $date_update;
    }

    public function setDateRemove($date_remove){
        $this->date_remove = $date_remove;
    }

    public function setActive($active){
        $this->$active = $active;
    }
}