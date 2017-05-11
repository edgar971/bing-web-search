<?php

use GuzzleHttp\Client;
use EPino\BingSearch\Response\BingResponse;
use Psr\Http\Message\ResponseInterface;

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

    public function testBingResponse() {

        $client = $this->getClient();

        $response = $client->request('searchdfdfdf');

        $this->assertInstanceOf(ResponseInterface::class, $response);

        $bingResponse = new BingResponse($response);

        $this->assertTrue(is_object($bingResponse->getData()));
        $this->assertEquals(0, $bingResponse->getNumberOfResults());
        $this->assertEquals(0, count($bingResponse->getResults()));
        $this->assertInstanceOf(ResponseInterface::class, $bingResponse->getResponse());

    }

    public function testSearchResponse() {

        $client = $this->getClient();

//        $response = $client->search('cats');
//
//        $response->getResults();

    }

}