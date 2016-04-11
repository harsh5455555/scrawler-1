<?php

/**
 * content goes here
 * 
 * @author : Pranjal Pandey
 * @package : Scrawler
 */

namespace Tests;
use GuzzleHttp\Client;


class APITest extends \PHPUnit_Framework_TestCase {


    function testGET(){
    $client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'http://localhost:8000',
     ]);
     
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
