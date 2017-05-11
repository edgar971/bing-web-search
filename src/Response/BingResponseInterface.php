<?php

namespace EPino\BingSearch\Response;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface BingResponseInterface
 *
 * @package EPino\BingSearch\Response
 */
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