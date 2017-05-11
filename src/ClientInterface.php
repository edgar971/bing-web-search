<?php

namespace EPino\BingSearch;

use EPino\BingSearch\Response\BingResponseInterface;
use EPino\BingSearch\Response\Web;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface ClientInterface
 * @package EPino\BingSearch
 */
interface ClientInterface {


    /**
     * Makes a regular search
     *
     * @return mixed
     */
    public function search();

    /**
     * Makes a website search
     *
     * @return Web
     */
    public function web();

    /**
     * Makes an image web search
     *
     * @return mixed
     */
    public function image();

    /**
     * Makes a news web search
     * @return mixed
     */
    public function news();

    /**
     * Returns the Guzzle Client
     *
     * @return \GuzzleHttp\Client
     */
    public function getGuzzleClient();

    /**
     * @param $endpoint
     * @param string $method
     * @param array $options
     * @return ResponseInterface
     */
    public function request($endpoint, $method = 'GET', $options = []);



}