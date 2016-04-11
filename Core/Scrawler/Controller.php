<?php

/**
 * Parent Class to be extended by Controllers
 *
 * @author : Pranjal Pandey
 * @package : Scrawler
 *
 */

namespace Scrawler;


/* just pull all the services from container so that controller can use them.
use loop to pull from DI and assigne to variable */


class Controller {
    //---------------------------------------------------------------//

    /**
     * Stores the object of Template engine
     * @var object
     */
    public $t;

    /**
     * Stores the object of database class
     * @var object
     */
    public $db;

    /**
     * Stores the object of mailer class
     * @var object
     */
    public $mail;
    
    /**
     * Stores the object of http class
     * @var object
     */
    public $http;

    //---------------------------------------------------------------//

    /* Constructor overloading to store objects in variables */
    function __construct() {
        $this->t = new Templates();
        if (file_exists(__DIR__ . '/../../App/config.ini')) {
            $this->db = new Database();
        }
        $this->mail = new Mail();
        $this->http = new Http();
    }

    //---------------------------------------------------------------//

    /* Helper Method to return template object */
    public function t() {
        return $this->t;
    }

    //---------------------------------------------------------------//

    /* Helper Method to return database object */
    public function db() {
        return $this->db;
    }

    //--------------------------------------------------------------//
    
    /* Helper Method to return template object */

    public function mail() {
        return $this->mail;
    }

    
    //--------------------------------------------------------------//
    
    /* Helper Method to return template object */

    public function http() {
        return $this->http;
    }

    //---------------------------------------------------------------//
    
    
}
