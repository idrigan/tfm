<?php

namespace Component\Domain\DTO;


class CommentsDTO
{
    private $comments;

    public function __construct()
    {
        $this->commentsDTO = array();
    }

    public function setComments( $comments = array() ){
        $this->comments = $comments;
    }

    public function addComment(CommentDTO $commentDTO){
        $this->comments[] = $commentDTO;
    }

    public function getComments(){
        return $this->comments;
    }
}