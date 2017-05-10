<?php

namespace EPino\BingSearch\Response;

use Psr\Http\Message\ResponseInterface;

class BingResponse implements BingResponseInterface {

    /**
     * @var \Psr\Http\Message\ResponseInterface;
     */
    protected $response;

    protected $data;

    const TYPES = [
        "WEB" => "webPages",
        "NEWS" => "news"
    ];

    /**
     * https://docs.microsoft.com/en-us/rest/api/cognitiveservices/bing-web-api-v5-reference#searchresponse
     * @var string
     */
    protected $type;

    /**
     * BingResponse constructor.
     * @param ResponseInterface $response
     */
    function __construct(ResponseInterface $response) {

        $this->response = $response;

        $this->type = self::TYPES["WEB"];

        $this->data = $this->decodeBody($response);


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
     * @return array
     */
    public function getResults() {

        $type = $this->type;

        return (!empty($this->data) && isset($this->data->$type)) ? $this->data->$type->value : [];

    }

    public function getNumberOfResults() {

        $type = $this->type;

        return (int) (!empty($this->data) && isset($this->data->$type)) ? $this->data->$type->totalEstimatedMatches : 0;

    }


}