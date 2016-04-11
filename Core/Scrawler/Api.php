<?php

/**
 * API protecting class
 * 
 * @author : Pranjal Pandey
 * @package : Scrawler
 */

namespace Scrawler;

class Api {
//---------------------------------------------------------------//

    /**
     * Stores the auth username
     * @var string
     */
    protected $username;

    /**
     * Stores the auth password
     * @var string
     */
    protected $password;

    //---------------------------------------------------------------//

    /*
     * Checks if request is an API request
     * return boolean
     */


    function isAPI() {
        $http = new \Scrawler\Http();
        $header = $http->getallheaders();
        if (isset($header[X-SCRAWLER-USERNAME]) && isset($header[X-SCRAWLER-PASSWORD])) {
            $this->username = $header[X-SCRAWLER-USERNAME];
            $this->password = $header[X-SCRAWLER-PASSWORD];
            return TRUE;
        }

        return FALSE;
    }

//---------------------------------------------------------------//

    /*
     * Authenticate API request
     * return boolean
     */

    function authAPI() {
        if ($this->isAPI()) {
            $config = parse_ini_file(__DIR__ . '/../../App/config.ini');
            $user = $config['APIusername'];
            $pass = $config['APIpassword'];
            if ($this->username == $user && $this->password == $pass) {
                return TRUE;
            }
            return FALSE;
        }
    }

//---------------------------------------------------------------//
}
