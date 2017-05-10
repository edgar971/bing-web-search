<?php

namespace EPino\BingSearch;

use GuzzleHttp\Client as GuzzleClient;
use Exception;

class Client implements ClientInterface {

    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * Header for API Authorization
     */
    const AUTH_HEADER = 'Ocp-Apim-Subscription-Key';


    public function __construct($token = null, $endpoint = 'https://api.cognitive.microsoft.com/bing/v5.0/', $guzzle_config = []) {

        if(!$token) {
            throw new Exception("Token is Required");
        }

        $this->client = new GuzzleClient([
            'base_uri' => $endpoint,
            'headers' => [
                self::AUTH_HEADER => $token
            ]
        ]);

    }

    public function web() {

        // TODO: Implement web() method.

    }

    public function image() {

        // TODO: Implement image() method.

    }

    public function search() {

        // TODO: Implement search() method.

    }

    public function news() {

        // TODO: Implement news() method.

    }

    public function getGuzzleClient() {

        return $this->client;

    }


}