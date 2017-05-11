<?php

namespace EPino\BingSearch\Response;

use Psr\Http\Message\ResponseInterface;

/**
 * Class Web
 * @package EPino\BingSearch\Response
 */
class Web extends BingResponse {

    /**
     * BingWebResponse constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response) {

        $this->type = BingResponse::TYPES["WEB"];
        parent::__construct($response);

    }



}