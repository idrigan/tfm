<?php

namespace Component\Domain\DTO;


use Component\Domain\Entity\ResponsePublication;

class CommentDTO
{
    private $id;
    private $idUser;
    private $comment;
    private $trackId;
    private $url;
    private $type;
    private $email;
    private $date;
    private $responses;

    /**
     * CommentDTO constructor.
     * @param $idUser
     * @param $comment
     * @param $trackId
     */
    public function __construct($id, $idUser = "", $comment = "", $trackId = "" ,$url ="" ,$type = "",$email = '',$date = '',$responses = array())
    {
        $this->id = $id;
        $this->idUser = $idUser;
        $this->comment = $comment;
        $this->trackId = $trackId;
        $this->url = $url;
        $this->type = $type;
        $this->email = $email;
        $this->date = $date;
        $this->responses = $responses;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $data
     */
    public function setData($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getTrackId()
    {
        return $this->trackId;
    }

    /**
     * @param mixed $trackId
     */
    public function setTrackId($trackId)
    {
        $this->trackId = $trackId;
    }

    public function addResponse(ResponsePublication $responsePublication){
        $this->responses[] = $responsePublication;
    }

    public function getResponses(){
        return $this->responses;
    }

    public function setResponses( $responses = array()){
        $this->responses = $responses;
    }
}