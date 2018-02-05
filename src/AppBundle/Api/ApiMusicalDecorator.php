<?php


namespace AppBundle\Api;


use Component\Application\Api\InterfaceMusical;
use Predis\Client;


final class ApiMusicalDecorator implements InterfaceMusical
{

    private $cache;
    private $api;

    public function __construct(ApiMusical $api,Client $redis)
    {
       $this->api = $api;
       $this->cache = $redis;
    }

    public function search($value,$limit = 10,$offset = 0)
    {
       if (!$this->cache->exists($value)){
           $result = $this->api->search($value,$limit,$offset);
           $this->cache->set($value,json_encode($result));
           return $result;
       }else{
           return json_decode($this->cache->get($value),true);
       }
    }
}