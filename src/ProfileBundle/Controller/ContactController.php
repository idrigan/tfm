<?php


namespace ProfileBundle\Controller;


use Symfony\Component\HttpFoundation\Request;

class ContactController extends BaseController
{

    public function execute(Request $request){

        parent::checkUser($request);

        return $this->render('@ProfileBundle/Resources/views/contact.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
            'user'=>$this->user
        ]);
    }


    public function send(Request $request){

    }
}