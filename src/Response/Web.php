<?php

namespace EPino\BingSearch\Response;

use Psr\Http\Message\ResponseInterface;

/**
 * Class Web
 * @package EPino\BingSearch\Response
 */
class Web extends BingResponse {

    /**
     *
     * @docs https://docs.microsoft.com/en-us/rest/api/cognitiveservices/bing-web-api-v5-reference#searchresponse
     * @var string
     */
    protected $type;

    /**
     * BingWebResponse constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response) {

        $this->type = BingResponse::TYPES["WEB"];

        parent::__construct($response);

    }

    /**
     * @inheritdoc
     */
    public function getResults() {

        $type = $this->type;

        return (!empty($this->data) && isset($this->data->$type)) ? $this->data->$type->value : [];

    }




}