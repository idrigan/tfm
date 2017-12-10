<?php


namespace AppBundle\Api;


use Component\Application\Api\InterfaceMusical;
use Symfony\Component\DependencyInjection\ContainerInterface;


class ApiMusical implements InterfaceMusical
{
    private $spotifySession;


    public function __construct(ContainerInterface $container)
    {
        $spotify = $container->get('app.factorySpotify')->createSpotifyFactory($container->getParameter('client_id'),$container->getParameter('client_secret'));

        $this->apiSpotify = $spotify->getSpotifyApi();


    }

    public function search($value,$limit = 10,$offset = 0){
        //$this->getRefreshToken();
        return $this->apiSpotify->search($value,array("artist","album","playlist","track"),array('limit'=>$limit,'offset'=>$offset));
    }


}