<?php

namespace EPino\BingSearch\Response;

use EPino\BingSearch\Traits\ResponsePagination;
use EPino\BingSearch\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Web
 * @package EPino\BingSearch\Response
 */
class Web extends BingResponse {

    use ResponsePagination;

    /**
     *
     * @docs https://docs.microsoft.com/en-us/rest/api/cognitiveservices/bing-web-api-v5-reference#searchresponse
     * @var string
     */
    protected $type;

    /**
     * Web constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response, Client $client, $request_options = []) {

        $this->type = BingResponse::TYPES["WEB"];
        parent::__construct($response, $client, $request_options);

        $this->updatePaginationParams();


    }

    /**
     * @inheritdoc
     */
    public function getResults() {

        $type = $this->type;

        return (!empty($this->data) && isset($this->data->$type)) ? $this->data->$type->value : [];

    }




}