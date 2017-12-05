<?php


namespace AppBundle\Api;


use Component\Application\Api\InterfaceMusical;
use SpotifyWebAPI;
use Symfony\Component\DependencyInjection\ContainerInterface;


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

    public function search($value,$limit = 10,$offset = 0){
        $this->getRefreshToken();
        return $this->apiSpotify->search($value,array("artist","album","playlist","track"),array('limit'=>$limit,'offset'=>$offset));
    }


    public function getToken(){
        return $this->spotifySession->getAccessToken();
    }

    private function getRefreshToken(){
        $refreshToken = $this->spotifySession->getRefreshToken();
        $this->spotifySession->refreshAccessToken($refreshToken);
        $accessToken = $this->spotifySession->getAccessToken();
        $this->apiSpotify->setAccessToken($accessToken);

    }
}