<?php


namespace AppBundle\Api;


use Component\Application\Api\InterfaceMusical;
use Symfony\Component\DependencyInjection\ContainerInterface;
use SpotifyWebAPI;

class ApiMusical implements InterfaceMusical
{
    private $apiSpotify;

    public function __construct(SpotifyWebAPI\SpotifyWebAPI $spotifyWebAPI)
    {
        //$spotify = $container->get('app.factorySpotify')->createSpotifyFactory($container->getParameter('client_id'),$container->getParameter('client_secret'));
        $this->apiSpotify = $spotifyWebAPI;
    }

    public function search($value,$limit = 10,$offset = 0){
        return $this->apiSpotify->search($value,array("artist","album","playlist","track"),array('limit'=>$limit,'offset'=>$offset));
    }


}