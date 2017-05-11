<?php

use EPino\BingSearch\Client;

class TestBase extends PHPUnit_Framework_TestCase {

    protected $client;

    /**
     * @return Client
     */
    public function getClient() {

        if(!$this->client) {

            $this->client = new Client(env('API_TOKEN', "234dfg8d5fdkdkfkd225"));

        }

        return $this->client;

    }

}