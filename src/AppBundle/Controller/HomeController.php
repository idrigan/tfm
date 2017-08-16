<?php


namespace AppBundle\Controller;


use AppBundle\Api\ApiMusical;
use Component\Domain\DTO\UserDTO;
use Component\Domain\Entity\User;
use ProfileBundle\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends BaseController
{
    private $spotify;

    public function index(Request $request){

        parent::checkUser($request);

        $this->spotify = $this->get('Api.musical');

        $tokenSpotify = $this->spotify->getToken();

        $user = array(
            'picture'=>$request->getSession()->get('picture'),
            'name'=>$request->getSession()->get('name'),
            'email'=>$request->getSession()->get('email'),
        );

        if ($this->user == null){
            return $this->redirect('/');
        }

        $getCommentUseCase = $this->get('app.comment.usecase.getAll');

        $userDto = new UserDTO();
        $userDto->setId($request->getSession()->get('id'));
        $comments = $getCommentUseCase->execute($userDto);

        return $this->renderCustomView('@AppBundle/Resources/views/home.html.twig',[
            'user' => $user,
            'comments'=>$comments->getComments()
        ]);

    }
}