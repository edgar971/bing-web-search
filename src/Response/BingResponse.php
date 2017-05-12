<?php

namespace EPino\BingSearch\Response;

use EPino\BingSearch\Client;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class BingResponse
 * @package EPino\BingSearch\Response
 */
class BingResponse implements BingResponseInterface {

    /**
     * @var \Psr\Http\Message\ResponseInterface;
     */
    protected $response;

    /**
     * @var object|\SimpleXMLElement
     */
    protected $data;

    /**
     * Guzzle Request Options
     *
     * @var array
     */
    protected $request_options;

    /**
     * Bing Response types
     * @docs https://docs.microsoft.com/en-us/rest/api/cognitiveservices/bing-web-api-v5-reference#searchresponse
     *
     */
    const TYPES = [
        "WEB" => "webPages",
        "NEWS" => "news",
        "IMAGES" => "images",
        "VIDEOS" => "videos"
    ];

    /**
     * @var Client
     */
    protected $client;

    protected $number_of_results;


    /**
     * BingResponse constructor.
     * @param ResponseInterface $response
     * @param Client $client
     * @param array $request_options
     */
    function __construct(ResponseInterface $response, Client $client, $request_options = []) {

        $this->response = $response;

        $this->type = self::TYPES["WEB"];

        $this->data = $this->decodeBody($response);

        $this->request_options = $request_options;

        $this->number_of_results = null;

    }

    /**
     * @param ResponseInterface $response
     * @return object|\SimpleXMLElement
     */
    protected function decodeBody(ResponseInterface $response) {

        //get the content type of the response. It can be XML or JSON.
        $contentType = implode(',', $response->getHeader('Content-Type'));

        //Convert the data to an array based on the content type.
        $data = ((bool) strpos($contentType, 'xml')) ? simplexml_load_string($response->getBody()) : \GuzzleHttp\json_decode($response->getBody(), false);

        //return the data.
        return $data;


    }

    /**
     * @inheritdoc
     */
    public function getResponse() {

        return $this->response;

    }

    /**
     * @inheritdoc
     */
    public function getData() {

        return $this->data;

    }

    /**
     * @inheritdoc
     */
    public function getResults() {

        $types = self::TYPES;
        $results = [];

        if(empty($this->data)) {
            return $results;
        }

        foreach($types as $type) {

            if(isset($this->data->$type)) {

                $results[$type] = $this->data->$type;

            }

        }

        return $results;

    }

    /**
     * @inheritdoc
     */
    public function getNumberOfResults() {

        $type = $this->type;

        if(is_null($this->number_of_results)) {
            $this->number_of_results = (int) (!empty($this->data) && isset($this->data->$type)) ? $this->data->$type->totalEstimatedMatches : 0;
        }

        return $this->number_of_results;

    }


}