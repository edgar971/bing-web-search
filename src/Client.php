<?php
/**
 * Bing Search Client.
 */
namespace EPino\BingSearch;

use EPino\BingSearch\Response\Web;
use GuzzleHttp\Client as GuzzleClient;
use Exception;

/**
 * Class Client
 *
 * @package EPino\BingSearch
 */
class Client implements ClientInterface {

    /**
     * Guzzle HTTP Client
     *
     * @var GuzzleClient
     */
    protected $client;

    /**
     * Header for API Authorization
     */
    const AUTH_HEADER = 'Ocp-Apim-Subscription-Key';


    /**
     * Client constructor.
     *
     * @param null $token
     * @param string $endpoint
     * @param array $guzzle_config
     * @throws Exception
     */
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


    /**
     * @inheritdoc
     */
    public function web($query = '') {

        $options = [
            'query' => [
                'q' => $query
            ]
        ];

        $response = $this->request('search', 'GET', $options);

        return new Web($response);

    }

    /**
     * @inheritdoc
     */
    public function image() {

        // TODO: Implement image() method.

    }

    /**
     * @inheritdoc
     */
    public function search() {

        // TODO: Implement search() method.

    }

    /**
     * @inheritdoc
     */
    public function news() {

        // TODO: Implement news() method.

    }

    /**
     * @inheritdoc
     */
    public function getGuzzleClient() {

        return $this->client;

    }

    /**
     * @inheritdoc
     */
    public function request($endpoint, $method = 'GET', $options = []) {

        return $response = $this->client->request($method, $endpoint, $options);


    }




}