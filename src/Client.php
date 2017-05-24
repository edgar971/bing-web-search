<?php
/**
 * Bing Search Client.
 */
namespace EPino\BingSearch;

use EPino\BingSearch\Response\BingResponse;
use EPino\BingSearch\Response\Web;
use GuzzleHttp\Client as GuzzleClient;
use Exception;
use GuzzleHttp\Psr7\Request;

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

    protected $request_options = [
        'query' => [
            'q' => '',
            'responseFilter' => '',
            'offset' => 0,
            'count' => 20
        ]
    ];

    protected $type;

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
            ],
            'http_errors' => false
        ]);

    }

    protected function createBingQueryParams($query = []) {

        $default = $this->request_options['query'];

        $query = array_merge($default, $query);

        return $query;

    }

    protected function getBingQueryParam($key, $default = null) {

        return array_get($this->request_options['query'], $key, $default);

    }

    /**
     * @inheritdoc
     */
    public function web($query = '') {


        $bing_query = $this->createBingQueryParams([
            'q' => $query,
            'responseFilter' => 'Webpages'
        ]);

        $this->request_options['query'] = $bing_query;
        $this->type = Web::class;

        return $this;

    }

    /**
     * @param int $page
     * @return $this
     */
    public function page($page = 1) {

        $count = $this->getBingQueryParam('count');
        $offset = $this->getBingQueryParam('offset');
        $new_offset = ($offset + $count) * $page;

        $query['offset'] = $new_offset;

        $this->request_options['query'] = $this->createBingQueryParams($query);

        return $this;


    }

    public function site($site) {

        $q = trim($this->getBingQueryParam('q'));
        $q = (empty($q)) ? $q : 'site:' . $site . ' ' . $q;

        $query['q'] = $q;

        $this->request_options['query'] = $this->createBingQueryParams($query);

        return $this;

    }

    /**
     * @return Web
     */
    public function get() {

        $response = $this->request('search', 'GET', $this->request_options);
        $type = new $this->type($response, $this, $this->request_options);

        return $type;

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
    public function search($query = '') {

        $options = [
            'query' => [
                'q' => $query
            ]
        ];

        $response = $this->request('search', 'GET', $options);

        return new BingResponse($response, $this->client, $options);

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

        $response = $this->client->request($method, $endpoint, $options);

        return $response;


    }




}