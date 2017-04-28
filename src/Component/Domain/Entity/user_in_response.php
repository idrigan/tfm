<?php


namespace Component\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity(repositoryClass="AppBundle\Repository\Publication\UserInResponseRepositoryImpl")
 *  @ORM\Table(name="user_in_response")
 */
class user_in_response
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

    public function __construct($idPublication,$idUser)
    {
        $this->idPublication = $idPublication;
        $this->idUser = $idUser;
    }
}