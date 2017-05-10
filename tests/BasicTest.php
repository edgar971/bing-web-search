<?php

use GuzzleHttp\Client;


class BasicTest extends TestBase {

    /**
     * Test the Guzzle client
     */
    public function testCorrectClient() {

        $client = $this->getClient();

        $this->assertInstanceOf(Client::class, $client->getGuzzleClient());

    }

    /**
     * Test the required headers
     */
    public function testGuzzleClientKey() {

        $client = $this->getClient()->getGuzzleClient();


        $this->assertArrayHasKey(\EPino\BingSearch\Client::AUTH_HEADER, $client->getConfig('headers'));

    }

    public function testRequest() {


        $client = $this->getClient();

        $response = $client->web('site:tests.com facebook');



    }

}