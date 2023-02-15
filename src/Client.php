<?php
namespace Huynp\Kiotviet;
use GuzzleHttp\Client as Request;

class Client{
    private $client_id, $client_secret, $token, $retailerCode;

    function __construct($client_id, $client_secret) {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->token = $this->getToken();
    }
    public function getToken(){
        $url = "https://id.kiotviet.vn/connect/token";
        $client = new Request([
            'base_uri' => 'http://httpbin.org',
            'timeout'  => 20.0,
            'verify' => false
        ]);
        
        $response = $client->request('POST', $url, [
            'headers'=>[
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'scopes'=>'PublicApi.Access',
                'grant_type' => 'client_credentials',
                'client_id'=>$this->client_id,
                'client_secret'=>$this->client_secret
                ]
        ]);
        $body = (string)$response->getBody();
        $result = json_decode($body, true);
        $accessToken = $result['access_token'];
        $payload = json_decode(base64_decode(explode('.', $accessToken)[1]), true);
        $this->retailerCode = $payload['client_RetailerCode'];
        return $accessToken;
        var_dump($body);
    }
    public function getRetailerCode(){
        return $this->retailerCode;
    }
    public function getAccessToken(){
        return $this->token;
    }
}