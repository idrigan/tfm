<?php


namespace AppBundle\Api;


use Component\Application\Api\InterfaceMusical;
use GuzzleHttp\Psr7\Response;
use SpotifyWebAPI;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class ApiMusical implements InterfaceMusical
{
    private $spotifySession;
    private $apiSpotify;

    public function __construct(ContainerInterface $container)
    {
        $this->apiSpotify = new SpotifyWebAPI\SpotifyWebAPI();

        $this->spotifySession = new SpotifyWebAPI\Session(
            $container->getParameter('client_id'),//client id
            $container->getParameter('client_secret')//client secret
//            $container->  getParameter('url')
        );

        $this->spotifySession->requestCredentialsToken();
        $token = $this->spotifySession->getAccessToken();

        $this->apiSpotify->setAccessToken($token);


    }

    public function search($value){
        return $this->apiSpotify->search($value,array("artist","album","playlist","track"));
    }
}