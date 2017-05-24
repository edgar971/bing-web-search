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

        $bingResponse = new BingResponse($response, $client);

        $this->assertTrue(is_object($bingResponse->getData()));
        $this->assertEquals(0, $bingResponse->getNumberOfResults());
        $this->assertEquals(0, count($bingResponse->getResults()));
        $this->assertInstanceOf(ResponseInterface::class, $bingResponse->getResponse());

    }

    public function testWebSearchResponse() {

        $client = $this->getClient();

        $web_response = $client->web('php')->get();

        $search_results = $web_response->getResults();

        $this->assertTrue(is_array($search_results));
        $this->assertGreaterThan(0, $search_results);
        $this->assertGreaterThan(0, $web_response->getNumberOfResults());


    }
//
//    public function testWebSearchPagination() {
//
//        $client = $this->getClient();
//
//        $web_results = $client->web('tips')->site('www.festfoods.com')->page(1)->get();
//
////        var_dump($web_results->getResults());
//
//
//    }

}