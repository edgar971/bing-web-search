<?php

use EPino\BingSearch\Client;

class TestBase extends PHPUnit_Framework_TestCase {

    protected $client;

    /**
     * @return Client
     */
    public function getClient() {

        if(!$this->client) {

            $this->client = new Client('933d33cc9fdfdfdfdf5845ad8d16343g421bbc5');

        }

        return $this->client;

    }

}