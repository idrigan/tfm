<?php

namespace Component\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 *  @ORM\Entity(repositoryClass="AppBundle\Repository\Publication\ResponsePublicationRepositoryImpl")
 *  @ORM\Table(name="response_publication")
 */
class ResponsePublication
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Publication")
     * @ORM\JoinColumn(name="id_publication", referencedColumnName="id")
     */
    private $idPublication;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $idUser;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateUpdate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $deleteUpdate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    public function __construct($idPublication, $idUser, $content, $dateCreate, $active)
    {
        $this->idPublication = $idPublication;
        $this->idUser = $idUser;
        $this->content = $content;
        $this->dateCreate = $dateCreate;
        $this->active = $active;
    }



}