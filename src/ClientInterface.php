<?php

namespace EPino\BingSearch;

interface ClientInterface {


    public function search();

    public function web();

    public function image();

    public function news();

    /**
     * Returns the Guzzle Client
     *
     * @return \GuzzleHttp\Client
     */
    public function getGuzzleClient();

    public function request($endpoint, $method = 'GET', $options = []);



}