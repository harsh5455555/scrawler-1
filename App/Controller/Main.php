<?php

/**
 * content goes here
 * 
 * @author : Pranjal Pandey
 * @package : Scrawler
 */

namespace App\Controller;

class Main extends \Scrawler\Controller {
    
    function allIndex()
    {
       
        $this->t()->body = $this->t()->render('home',['title'=>'hello']);
        $this->t()->draw();        
       
    }
    
}
