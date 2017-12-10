<?php

namespace AppBundle\Api;
use SpotifyWebAPI;

class SpotifyFactory
{
   private $spotifyApi;

   private $spotifySession;

   public function __construct()
   {

   }

   public static function createSpotifyFactory($clientId,$clientSecret){

       $spotifyFactory = new SpotifyFactory();


       $session =  new SpotifyWebAPI\Session(
           $clientId,
           $clientSecret
       );

       $session->requestCredentialsToken();
       $token = $session->getAccessToken();


       $spotifyFactory->setSpotifySession($session);

       $api = new SpotifyWebAPI\SpotifyWebAPI();

       $api->setAccessToken($token);

       $spotifyFactory->setSpotifyApi($api);

       return $spotifyFactory;
   }

    /**
     * @return SpotifyWebAPI\Session
     */
    public function getSpotifySession()
    {
        return $this->spotifySession;
    }

    /**
     * @param SpotifyWebAPI\Session $spotifySession
     */
    public function setSpotifySession($spotifySession)
    {
        $this->spotifySession = $spotifySession;
    }

    /**
     * @return SpotifyWebAPI\SpotifyWebAPI
     */
    public function getSpotifyApi()
    {
        return $this->spotifyApi;
    }

    /**
     * @param SpotifyWebAPI\SpotifyWebAPI $spotifyApi
     */
    public function setSpotifyApi($spotifyApi)
    {
        $this->spotifyApi = $spotifyApi;
    }


}