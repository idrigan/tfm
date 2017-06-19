<?php


namespace AppBundle\Controller;


use AppBundle\Api\ApiMusical;
use ProfileBundle\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends BaseController
{
    private $spotify;

    public function index(Request $request){

        parent::checkUser($request);

        $this->spotify = $this->get('Api.musical');

       // $this->spotify->configure($_GET['code']);

        $user = array(
            'picture'=>$request->getSession()->get('picture'),
            'name'=>$request->getSession()->get('name'),
            'email'=>$request->getSession()->get('email'),
        );


        if ($this->user == null){
            return $this->redirect('/');
        }

        return $this->render('@AppBundle/Resources/views/home.html.twig', [
                'user' => $user]
        );
    }
}