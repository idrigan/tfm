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

   public static function createSpotifyFactory(ContainerInterface $container){

       $session =  new SpotifyWebAPI\Session(
           $container->getParameter('client_id'),
           $container->getParameter('client_secret')
       );

       $session->requestCredentialsToken();
       $token = $session->getAccessToken();


       $api = new SpotifyWebAPI\SpotifyWebAPI();

       $api->setAccessToken($token);

       return $api;
   }


    public function getSpotifySession()
    {
        return $this->spotifySession;
    }

    public function setSpotifySession($spotifySession)
    {
        $this->spotifySession = $spotifySession;
    }


    public function getSpotifyApi()
    {
        return $this->spotifyApi;
    }


    public function setSpotifyApi($spotifyApi)
    {
        $this->spotifyApi = $spotifyApi;
    }


}