<?php


namespace AppBundle\Api;


use Component\Application\Api\InterfaceMusical;
use SpotifyWebAPI;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class ApiMusicalDecorator implements InterfaceMusical
{
    private $spotifySession;
    private $apiSpotify;
    private $cache;

    public function __construct(ContainerInterface $container)
    {
        $this->apiSpotify = new SpotifyWebAPI\SpotifyWebAPI();

        $this->spotifySession = new SpotifyWebAPI\Session(
            $container->getParameter('client_id'),//client id
            $container->getParameter('client_secret')//client secret
        );

        $this->spotifySession->requestCredentialsToken();
        $token = $this->spotifySession->getAccessToken();

        $this->apiSpotify->setAccessToken($token);


    }

    public function search($value,$limit = 10,$offset = 0)
    {
       // $this->getRefreshToken();

        if ($this->spotifySession->getTokenExpiration() <= time()){
            $this->getRefreshToken();
        }
         $this->cache = new FilesystemAdapter();
        $cacheApi = $this->cache->getItem($value);
        if (!$cacheApi->isHit()){
            $result = $this->apiSpotify->search($value,array("artist","album","playlist","track"),array('limit'=>$limit,'offset'=>$offset));
            $cacheApi->set($result);
            $this->cache->save($cacheApi);
            return $result;
        }else{
            return $cacheApi->get();
        }
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