<?php

namespace EPino\BingSearch\Response;

use Psr\Http\Message\ResponseInterface;

interface BingResponseInterface {

    /**
     * @return ResponseInterface
     */
    public function getResponse();

    /**
     * @return object
     */
    public function getData();

    /**
     * @return array|object
     */
    public function getResults();

    /**
     * @return int
     */
    public function getNumberOfResults();

}