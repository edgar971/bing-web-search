<?php

use EPino\BingSearch\Client;

class TestBase extends PHPUnit_Framework_TestCase {

    protected $client;

    /**
     * @return Client
     */
    public function getClient() {

        if(!$this->client) {

            $this->client = new Client('966de33cc9df5adfdfdfdf031bbc5');

        }

        return $this->client;

    }

}