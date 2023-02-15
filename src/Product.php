<?php
namespace Huynp\Kiotviet;
use GuzzleHttp\Client as Request;
use Huynp\Kiotviet\Client;

class Product{
    private Client $client;
    private array $headers;

    function __construct(Client $client) {
        $this->client = $client;
        $this->headers = [
            'Retailer' => $client->getRetailerCode(),
            'Authorization' => "Bearer ".$client->getAccessToken(),
        ];
    }
    public function getList($limit = 20, $page = 0){
        $url = "https://public.kiotapi.com/products?includeInventory=true&currentItem={$page}&pageSize={$limit}";
        $client = new Request([
            'base_uri' => 'http://httpbin.org',
            'timeout'  => 20.0,
        ]);
        
        $response = $client->request('GET', $url, [
            'headers'=>$this->headers,
           
        ]);
        $body = (string)$response->getBody();
        return json_decode($body, true)['data'];
    }
}