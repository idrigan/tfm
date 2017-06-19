<?php


namespace ProfileBundle\Controller;


use Component\Domain\DTO\UserDTO;
use Symfony\Component\HttpFoundation\Request;

class ProfileController  extends BaseController
{

    public function execute(Request $request){

        parent::checkUser($request);

        $userDTO = new UserDTO();
        $userDTO->setId($this->user['id']);

        $userUseCase = $this->get('app.user.usecase.getuser');
        $userData = $userUseCase->getById($userDTO);

        return $this->render('@ProfileBundle/Resources/views/profile.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
                'userData' => $userData,
                'user'=>$this->user]
        );
    }

}