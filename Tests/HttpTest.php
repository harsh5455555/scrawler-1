<?php

/**
 * content goes here
 * 
 * @author : Pranjal Pandey
 * @package : Scrawler
 */

namespace Tests;

class HttpTest extends \PHPUnit_Framework_TestCase {
    
    function testURL(){
        $http = new \Scrawler\Http();
        $url = $http->url();
        $this->assertNotEmpty($url);
    }
    
}
