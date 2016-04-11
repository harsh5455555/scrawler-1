<?php

/**
 * content goes here
 * 
 * @author : Pranjal Pandey
 * @package : Scrawler
 */
namespace Tests;
class TemplateTest extends \PHPUnit_Framework_TestCase{
    
    function testRender()
    {
        $t = new \Scrawler\Templates();
        $content= $t->render('home');
        $this->assertNotEmpty($content);
    }
    
}
