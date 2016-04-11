<?php

/**
 * content goes here
 * 
 * @author : Pranjal Pandey
 * @package : Scrawler
 */

namespace Tests;


class HomeApiTest extends \PHPUnit_Framework_TestCase {


    function testGET(){
    $client = new \GuzzleHttp\Client(['base_uri' => 'http://127.0.0.1:9000']);
     
     $client->request('GET', '/', [
    'headers' => [
        'X-SCRAWLER-USERNAME'      => "scrawler",
        'X-SCRAWLER-PASSWORD'      => "xjb48b43e2z"         ]
]);

    $response = $request->send();
    $this->assertEquals(201, $response->getStatusCode());
    $data = json_decode($response->getBody(true), true);
    $this->assertArrayHasKey('test', $data);
    }
    
}
