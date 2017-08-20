<?php

namespace AppBundle\Controller;


use Component\Domain\DTO\CommentDTO;
use ProfileBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;


class CommentController extends BaseController
{
    public function save(Request $request){

        parent::checkUser($request);

        $params = $request->getContent();

        $idTrack = $request->get('id');
        $comment = $request->get('comment');
        $idUser= $this->user['id'];
        $uri = $request->get('url');
        $type = $request->get('type');

        if (empty($comment) && empty($idTrack)){
            $session = $request->getSession();
            $session->set("error","Don't have commentary o song");
            return $this->redirect("/home");
        }else {
            $commentCase = $this->get("app.comment.usecase.save");
            $commentDTO = new CommentDTO('',$idUser,$comment,$idTrack,$uri,$type);
            $commentCase->execute($commentDTO);
            return $this->redirect("/home");
        }
    }
}