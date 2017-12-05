<?php


namespace Component\Domain\DTO;


use Component\Domain\Entity\Publication;
use Component\Domain\Entity\User;

class ResponseCommentDTO
{
    private $publication;
    private $response;
    private $user;

    /**
     * ResponseCommentDTO constructor.
     * @param $comment
     * @param $response
     * @param $user
     */
    public function __construct(Publication $publication, $response, User $user)
    {
        $this->publication = $publication;
        $this->response = $response;
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * @param mixed $publication
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function getUser():User
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }


}