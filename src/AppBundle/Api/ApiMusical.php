<?php


namespace AppBundle\Api;


use Component\Application\Api\InterfaceMusical;
use SpotifyWebAPI;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ApiMusical implements InterfaceMusical
{
    private $spotify;

    public function __construct(ContainerInterface $container)
    {
        $this->spotify = new SpotifyWebAPI\Session(
            $container->getParameter('client_id'),//client id
            $container->getParameter('client_secret'),//client secret
            $container->getParameter('url')
        );

        $this->authorize();
    }

    private function authorize(){
      header('Location: ' . $this->spotify->getAuthorizeUrl());
    }
}