<?php

namespace ProfileBundle\Controller;


use Component\Domain\DTO\MusicalTasteDTO;
use Component\Domain\DTO\MusicalTastesDTO;
use Component\Domain\DTO\UserDTO;
use Component\Domain\Entity\MusicalTaste;
use Component\Domain\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class MusicalTastesController extends BaseController
{
    public function execute(Request $request){

        parent::checkUser($request);

        $musicalTastesUseCase = $this->get('app.user.usecase.getallmusicaltastesusecase');

        $musicalTastes = $musicalTastesUseCase->execute($this->user['id']);


        return $this->render('@ProfileBundle/Resources/views/musicalTastes.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
            'user'=>$this->user,
            'musicalTastes'=>$musicalTastes->getMusicalTastes(),


        ]);
    }

    public function save(Request $request){

        parent::checkUser($request);
        $data = $request->request->get('musical-tastes');

        $musicalTastes = new MusicalTastesDTO($this->user['id']);

        $result = array();
        foreach ($data as $d){
            $musicalTaste = new MusicalTaste($d);
            $musicalTasteDTO = new MusicalTasteDTO($musicalTaste);
            $musicalTastes->addMusicalTaste($musicalTasteDTO);
        }

        $saveMusicalTaste = $this->get('app.user.usecase.savemusicaltastesusecase');

        if ($saveMusicalTaste->execute($musicalTastes)){
            return $this->redirect("/musical-tastes");
        }else{
            throw $this->createNotFoundException('Error save musical tastes');
        }

    }



}