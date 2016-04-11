<?php

/**
 * content goes here
 * 
 * @author : Pranjal Pandey
 * @package : Scrawler
 */

namespace Tests;

class HomeApiTest extends \PHPUnit_Framework_TestCase {

    function testGET() {
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost:8000']);

        $response = $client->request('GET', '/', [
            'headers' => [
                'X-SCRAWLER-USERNAME' => "scrawler",
                'X-SCRAWLER-PASSWORD' => "xjb48b43e2z"]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        echo $response->getBody(true);
        //$this->assertArrayHasKey('test', $data);
    }

}
