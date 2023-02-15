<?php
namespace Huynp\Kiotviet;
use GuzzleHttp\Client as Request;
use Huynp\Kiotviet\Client;

class Category{
    private $client;
    private $headers;

    function __construct($client) {
        $this->client = $client;
        $this->headers = [
            'Retailer' => $client->getRetailerCode(),
            'Authorization' => "Bearer ".$client->getAccessToken(),
        ];
    }
    public function getList($limit = 20, $page = 0){
        $url = "https://public.kiotapi.com/categories?&currentItem={$page}&pageSize={$limit}";
        $client = new Request([
            'base_uri' => 'http://httpbin.org',
            'timeout'  => 20.0,
            'verify' => false
        ]);
        
        $response = $client->request('GET', $url, [
            'headers'=>$this->headers,
           
        ]);
        $body = (string)$response->getBody();
        return json_decode($body, true)['data'];
    }
}